<?php

namespace App\Http\Controllers;

use App\Models\DailyRegister;
use App\Models\DailyRegistersLine;
use App\Models\AccountCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JournalEntryController extends Controller
{
    /**
     * Mostrar la lista de asientos contables.
     */
    public function index()
    {
        $entries = DailyRegister::with('lines.accountCataloge')
            ->where('mayor', 'N') // Solo mostrar partidas no mayorizadas
            ->orderBy('date_register', 'desc')
            ->paginate(10);

        return view('journal.index', compact('entries'));
    }

    /**
     * Mostrar el formulario para crear un nuevo asiento.
     */
    public function create()
    {
        // Obtener solo las cuentas que aceptan transacciones
        $accounts = AccountCatalog::where('accept_transaction', 'S')
            ->orderBy('code')
            ->get();

        return view('entries.create', compact('accounts'));
    }

    /**
     * Almacenar un nuevo asiento contable.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_register' => 'required|date',
            'description' => 'required|string|max:200',
            'lines' => 'required|array|min:2',
            'lines.*.account_id' => 'required|exists:account_catalogs,id',
            'lines.*.debit_amount' => 'nullable|numeric|min:0|max:9999.9999',
            'lines.*.credit_amount' => 'nullable|numeric|min:0|max:9999.9999',
        ]);

        // Validar que cada línea tenga débito o crédito (no ambos)
        foreach ($request->lines as $index => $line) {
            if ((!$line['debit_amount'] && !$line['credit_amount']) || 
                ($line['debit_amount'] && $line['credit_amount'])) {
                return back()->withErrors([
                    "lines.{$index}" => 'Cada línea debe tener débito O crédito, no ambos ni ninguno.'
                ])->withInput();
            }
        }

        // Validar que débitos = créditos
        $totalDebits = collect($request->lines)->sum('debit_amount');
        $totalCredits = collect($request->lines)->sum('credit_amount');

        if ($totalDebits != $totalCredits) {
            return back()->withErrors([
                'balance' => 'La suma de débitos debe ser igual a la suma de créditos.'
            ])->withInput();
        }

        DB::beginTransaction();
        try {
            // Crear el asiento principal
            $entry = DailyRegister::create([
                'date_register' => $request->date_register,
                'description' => $request->description,
                'mount_debit' => $totalDebits,
                'mount_credit' => $totalCredits,
                'balance' => 0, // Balance = 0 cuando débitos = créditos
                'mayor' => 'N'
            ]);

            // Crear las líneas del asiento
            foreach ($request->lines as $index => $lineData) {
                DailyRegistersLine::create([
                    'daily_register_id' => $entry->id,
                    'line' => $index + 1,
                    'account_catalog_id' => $lineData['account_id'],
                    'debit_amount' => $lineData['debit_amount'] ?? 0,
                    'credit_amount' => $lineData['credit_amount'] ?? 0,
                ]);
            }

            DB::commit();
            return redirect()->route('journal.index')->with('success', 'Asiento contable creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al crear el asiento: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * API: Obtener cuentas que aceptan transacciones para autocomplete
     */
    public function getTransactionAccounts(Request $request)
    {
        $search = $request->get('search', '');
        
        $accounts = AccountCatalog::where('accept_transaction', 'S')
            ->where(function($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('code')
            ->limit(10)
            ->get(['id', 'code', 'description']);

        return response()->json($accounts);
    }

    /**
     * Mostrar un asiento específico.
     */
    public function show($id)
    {
        $entry = DailyRegister::with('lines.accountCataloge')->findOrFail($id);
        return view('entries.show', compact('entry'));
    }

    /**
     * Mayorizar una partida de diario.
     */
    public function mayorize($id)
    {
        try {
            $entry = DailyRegister::findOrFail($id);
            
            if ($entry->mayor === 'Y') {
                return response()->json([
                    'success' => false, 
                    'message' => 'Esta partida ya ha sido mayorizada.'
                ]);
            }

            $entry->update(['mayor' => 'Y']);
            
            return response()->json([
                'success' => true, 
                'message' => 'Partida mayorizada exitosamente.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error al mayorizar la partida.'
            ], 500);
        }
    }

    /**
     * Eliminar un asiento contable.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $entry = DailyRegister::findOrFail($id);
            
            // Eliminar primero las líneas
            $entry->lines()->delete();
            
            // Luego eliminar el asiento
            $entry->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Asiento eliminado exitosamente.']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error al eliminar el asiento.'], 500);
        }
    }
}