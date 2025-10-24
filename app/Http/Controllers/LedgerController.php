<?php

namespace App\Http\Controllers;

use App\Models\AccountCatalog;
use App\Models\DailyRegister;
use App\Models\DailyRegistersLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgerController extends Controller
{
    /**
     * Mostrar el libro mayor con las cuentas que aceptan movimientos.
     */
    public function index()
    {
        // Obtener todas las cuentas que aceptan transacciones
        $accounts = AccountCatalog::where('accept_transaction', 'S')
            ->withSum(['dailyRegisterLines as total_debits' => function($query) {
                $query->whereHas('dailyRegister', function($subQuery) {
                    $subQuery->where('mayor', 'Y');
                });
            }], 'debit_amount')
            ->withSum(['dailyRegisterLines as total_credits' => function($query) {
                $query->whereHas('dailyRegister', function($subQuery) {
                    $subQuery->where('mayor', 'Y');
                });
            }], 'credit_amount')
            ->orderBy('code')
            ->paginate(15);

        // Calcular saldos para cada cuenta
        foreach ($accounts as $account) {
            $account->current_balance = ($account->total_debits ?? 0) - ($account->total_credits ?? 0);
        }

        return view('ledger.index', compact('accounts'));
    }

    /**
     * Mostrar el detalle de movimientos de una cuenta específica.
     */
    public function show($accountId)
    {
        $account = AccountCatalog::where('accept_transaction', 'S')->findOrFail($accountId);
        
        // Obtener todas las líneas mayorizadas de esta cuenta
        $movements = DailyRegistersLine::with(['dailyRegister'])
            ->where('account_catalog_id', $accountId)
            ->whereHas('dailyRegister', function($query) {
                $query->where('mayor', 'Y');
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Calcular saldos acumulados
        $runningBalance = 0;
        $totalDebits = 0;
        $totalCredits = 0;

        foreach ($movements as $movement) {
            $totalDebits += $movement->debit_amount;
            $totalCredits += $movement->credit_amount;
            $runningBalance += $movement->debit_amount - $movement->credit_amount;
            $movement->running_balance = $runningBalance;
        }

        $currentBalance = $totalDebits - $totalCredits;

        return view('ledger.show', compact('account', 'movements', 'totalDebits', 'totalCredits', 'currentBalance'));
    }

    /**
     * Obtener el resumen de saldos por tipo de cuenta.
     */
    public function balanceSheet()
    {
        $balances = AccountCatalog::where('accept_transaction', 'S')
            ->whereHas('dailyRegisterLines.dailyRegister', function($query) {
                $query->where('mayor', 'Y');
            })
            ->with(['dailyRegisterLines' => function($query) {
                $query->whereHas('dailyRegister', function($subQuery) {
                    $subQuery->where('mayor', 'Y');
                });
            }])
            ->get()
            ->groupBy('type_account');

        $summary = [];
        $accountTypes = [
            'A' => 'Activos',
            'P' => 'Pasivos', 
            'K' => 'Capital',
            'I' => 'Ingresos',
            'G' => 'Gastos'
        ];

        foreach ($accountTypes as $typeCode => $typeName) {
            if (isset($balances[$typeCode])) {
                $typeAccounts = $balances[$typeCode];
                $totalDebits = $typeAccounts->sum(function($account) {
                    return $account->dailyRegisterLines->sum('debit_amount');
                });
                $totalCredits = $typeAccounts->sum(function($account) {
                    return $account->dailyRegisterLines->sum('credit_amount');
                });
                
                $summary[$typeCode] = [
                    'name' => $typeName,
                    'debits' => $totalDebits,
                    'credits' => $totalCredits,
                    'balance' => $totalDebits - $totalCredits,
                    'accounts_count' => $typeAccounts->count()
                ];
            }
        }

        return view('ledger.balance', compact('summary'));
    }
}