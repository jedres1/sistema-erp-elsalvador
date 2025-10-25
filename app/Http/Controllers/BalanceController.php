<?php

namespace App\Http\Controllers;

use App\Models\AccountCatalog;
use App\Models\DailyRegister;
use App\Models\DailyRegistersLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    /**
     * Mostrar el balance general con cuentas de 4 dígitos agrupadas por tipo
     */
    public function index()
    {
        // Obtener TODAS las cuentas que representan agrupaciones de 4 dígitos + 8 ceros
        // SOLO para cuentas 1, 2 y 3 (Activos, Pasivos, Capital)
        $groupingAccounts = AccountCatalog::with(['dailyRegisterLines' => function($query) {
                $query->whereHas('dailyRegister', function($subQuery) {
                    $subQuery->where('mayor', 'Y');
                });
            }])
            ->orderBy('code')
            ->get()
            ->filter(function($account) {
                // Filtro para cuentas con patrón exacto de 4 dígitos + 8 ceros (ej: 110200000000)
                $cleanCode = str_replace('.', '', $account->code);
                return preg_match('/^[0-9]{4}00000000$/', $cleanCode);
            })
            ->filter(function($account) {
                // Solo incluir cuentas 1, 2 y 3 (Activo, Pasivo y Capital)
                $cleanCode = str_replace('.', '', $account->code);
                $firstDigit = substr($cleanCode, 0, 1);
                return in_array($firstDigit, ['1', '2', '3']) && in_array($account->type_account, ['A', 'P', 'K']);
            });

        // Obtener todas las subcuentas con movimientos para acumular en sus agrupaciones
        $allAccountsWithMovements = AccountCatalog::whereHas('dailyRegisterLines.dailyRegister', function($query) {
                $query->where('mayor', 'Y');
            })
            ->with(['dailyRegisterLines' => function($query) {
                $query->whereHas('dailyRegister', function($subQuery) {
                    $subQuery->where('mayor', 'Y');
                });
            }])
            ->get();

        // Calcular saldos para cuentas del Balance General (4 dígitos + 8 ceros)
        foreach ($groupingAccounts as $groupingAccount) {
            $groupingAccount->clean_code = str_replace('.', '', $groupingAccount->code);
            $groupingCodePrefix = substr($groupingAccount->clean_code, 0, 4); // Primeros 4 dígitos
            
            // Saldo directo de la cuenta de agrupación
            $directBalance = $groupingAccount->dailyRegisterLines->sum('debit_amount') - 
                           $groupingAccount->dailyRegisterLines->sum('credit_amount');
            
            // Saldo acumulado de todas las subcuentas que pertenecen a esta agrupación
            $accumulatedBalance = 0;
            foreach ($allAccountsWithMovements as $subAccount) {
                $subAccountCleanCode = str_replace('.', '', $subAccount->code);
                // Si la subcuenta comienza con los mismos 4 dígitos, acumular su saldo
                if (str_starts_with($subAccountCleanCode, $groupingCodePrefix) && $subAccountCleanCode !== $groupingAccount->clean_code) {
                    $subBalance = $subAccount->dailyRegisterLines->sum('debit_amount') - 
                                $subAccount->dailyRegisterLines->sum('credit_amount');
                    $accumulatedBalance += $subBalance;
                }
            }
            
            $groupingAccount->balance = $directBalance + $accumulatedBalance;
        }

        // Agrupar las cuentas del Balance General por tipo
        $groupedAccounts = [
            'A' => $groupingAccounts->where('type_account', 'A')->sortBy('code'),
            'P' => $groupingAccounts->where('type_account', 'P')->sortBy('code'),
            'K' => $groupingAccounts->where('type_account', 'K')->sortBy('code')
        ];

        // Calcular totales por grupo del Balance General
        $totals = [
            'A' => $groupedAccounts['A']->sum('balance'),
            'P' => $groupedAccounts['P']->sum('balance'),
            'K' => $groupedAccounts['K']->sum('balance')
        ];

        $typeNames = [
            'A' => 'ACTIVOS',
            'P' => 'PASIVOS',
            'K' => 'CAPITAL'
        ];

        return view('balance.index', compact('groupedAccounts', 'totals', 'typeNames'));
    }
}