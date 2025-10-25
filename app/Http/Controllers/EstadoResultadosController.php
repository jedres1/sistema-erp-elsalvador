<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountCatalog;
use App\Models\DailyRegister;
use Illuminate\Support\Facades\DB;

class EstadoResultadosController extends Controller
{
    public function index()
    {
        // Obtener todas las cuentas del catálogo que son de cuentas 4 y 5 (gastos e ingresos)
        // con patrón de 2 dígitos + 10 ceros
        $accounts = AccountCatalog::all();
        
        // Filtrar cuentas para Estado de Resultados (cuentas 4 y 5 con 2 dígitos + 10 ceros)
        $resultAccounts = $accounts->filter(function($account) {
            $cleanCode = str_replace('.', '', $account->code);
            // Buscar patrón: 2 dígitos seguidos de 10 ceros
            if (preg_match('/^[0-9]{2}0000000000$/', $cleanCode)) {
                $firstDigit = substr($cleanCode, 0, 1);
                return in_array($firstDigit, ['4', '5']);
            }
            return false;
        });
        
        // Preparar datos para la vista
        $gastos = [];
        $ingresos = [];
        $totalGastos = 0;
        $totalIngresos = 0;
        
        foreach ($resultAccounts as $account) {
            $cleanCode = str_replace('.', '', $account->code);
            $firstDigit = substr($cleanCode, 0, 1);
            
            // Calcular saldo acumulado para esta cuenta de agrupación
            $saldoAcumulado = $this->calcularSaldoAcumulado($cleanCode);
            
            $accountData = [
                'code' => $account->code,
                'name' => $account->description,
                'balance' => $saldoAcumulado
            ];
            
            if ($firstDigit === '4') {
                $gastos[] = $accountData;
                $totalGastos += $saldoAcumulado;
            } elseif ($firstDigit === '5') {
                $ingresos[] = $accountData;
                $totalIngresos += $saldoAcumulado;
            }
        }
        
        // Calcular utilidad neta
        $utilidadNeta = $totalIngresos - $totalGastos;
        
        return view('estado-resultados.index', compact(
            'gastos', 
            'ingresos', 
            'totalGastos', 
            'totalIngresos', 
            'utilidadNeta'
        ));
    }
    
    private function calcularSaldoAcumulado($cleanCodeAgrupacion)
    {
        // Para Estado de Resultados, usar solo los primeros 2 dígitos
        $prefijoAgrupacion = substr($cleanCodeAgrupacion, 0, 2);
        
        // Obtener todas las subcuentas que empiecen con este prefijo de 2 dígitos
        $allAccounts = AccountCatalog::all();
        $subcuentas = $allAccounts->filter(function($account) use ($prefijoAgrupacion) {
            $cleanCode = str_replace('.', '', $account->code);
            return str_starts_with($cleanCode, $prefijoAgrupacion);
        });
        
        $saldoTotal = 0;
        
        foreach ($subcuentas as $subcuenta) {
            // Calcular saldo para esta subcuenta
            $saldo = $this->calcularSaldoCuenta($subcuenta->code);
            $saldoTotal += $saldo;
        }
        
        return $saldoTotal;
    }
    
    private function calcularSaldoCuenta($accountCode)
    {
        // Obtener el ID de la cuenta
        $account = AccountCatalog::where('code', $accountCode)->first();
        if (!$account) {
            return 0;
        }
        
        // Obtener movimientos de esta cuenta que estén mayorizados
        $movimientos = DB::table('daily_registers_line as drl')
            ->join('daily_registers as dr', 'drl.daily_register_id', '=', 'dr.id')
            ->where('drl.account_catalog_id', $account->id)
            ->where('dr.mayor', 'Y')
            ->select('drl.debit_amount', 'drl.credit_amount')
            ->get();
        
        $totalDebito = $movimientos->sum('debit_amount');
        $totalCredito = $movimientos->sum('credit_amount');
        
        // Para cuentas de gastos (4): saldo = débitos - créditos
        // Para cuentas de ingresos (5): saldo = créditos - débitos
        $cleanCode = str_replace('.', '', $accountCode);
        $firstDigit = substr($cleanCode, 0, 1);
        
        if ($firstDigit === '4') {
            // Gastos: débitos aumentan el saldo
            return $totalDebito - $totalCredito;
        } elseif ($firstDigit === '5') {
            // Ingresos: créditos aumentan el saldo
            return $totalCredito - $totalDebito;
        }
        
        return 0;
    }
}