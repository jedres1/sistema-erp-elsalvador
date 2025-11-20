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
        // Obtener todas las cuentas del catálogo
        $accounts = AccountCatalog::all();
        
        // Filtrar cuentas para Estado de Resultados (cuentas con tipo 'ingreso' y 'gasto' con 2 dígitos + 10 ceros)
        $resultAccounts = $accounts->filter(function($account) {
            $cleanCode = str_replace('.', '', $account->code);
            // Buscar patrón: 2 dígitos seguidos de 10 ceros
            if (preg_match('/^[0-9]{2}0000000000$/', $cleanCode)) {
                // Usar el nuevo campo type_account
                return in_array($account->type_account, ['ingreso', 'gasto']);
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
            
            // Calcular saldo acumulado para esta cuenta de agrupación
            $saldoAcumulado = $this->calcularSaldoAcumulado($cleanCode, $account->type_account);
            
            $accountData = [
                'code' => $account->code,
                'name' => $account->description,
                'balance' => $saldoAcumulado
            ];
            
            if ($account->type_account === 'ingreso') {
                $ingresos[] = $accountData;
                $totalIngresos += $saldoAcumulado;
            } elseif ($account->type_account === 'gasto') {
                $gastos[] = $accountData;
                $totalGastos += $saldoAcumulado;
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
    
    private function calcularSaldoAcumulado($cleanCodeAgrupacion, $typeAccount)
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
            $saldo = $this->calcularSaldoCuenta($subcuenta->code, $typeAccount);
            $saldoTotal += $saldo;
        }
        
        return $saldoTotal;
    }
    
    private function calcularSaldoCuenta($accountCode, $typeAccount)
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
        
        // Para cuentas de ingresos: saldo = créditos - débitos
        // Para cuentas de gastos: saldo = débitos - créditos
        if ($typeAccount === 'ingreso' || $account->type_account === 'ingreso') {
            // Ingresos: créditos aumentan el saldo
            return $totalCredito - $totalDebito;
        } elseif ($typeAccount === 'gasto' || $account->type_account === 'gasto') {
            // Gastos: débitos aumentan el saldo
            return $totalDebito - $totalCredito;
        }
        
        return 0;
    }
}