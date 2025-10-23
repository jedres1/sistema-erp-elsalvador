<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccountCatalog;
use Illuminate\Http\Request;

class AccountCatalogController extends Controller
{
    /**
     * Obtener todas las cuentas en formato jerárquico.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15); // Por defecto 15 cuentas por página
        $search = $request->get('search'); // Para búsqueda opcional
        
        $query = AccountCatalog::orderBy('code');
        
        // Si hay búsqueda, filtrar por código o descripción
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $listAccounts = $query->paginate($perPage);
        
        return response()->json($listAccounts, 200);
    }

    /**
     * Mostrar la vista para crear una nueva cuenta.
     */
    public function create()
    {
        $parentAccounts = AccountCatalog::all(); // Obtener todas las cuentas para ser posibles padres
        return view('accounts.create', compact('parentAccounts'));
    }

    /**
     * Crear una nueva cuenta.
     */
    public function store(Request $request)
    {
        $parent = null;

        // Verificar si existe una cuenta padre
        if ($request->has('parent_code')) {
            $parent = AccountCatalog::where('code', $request->input('parent_code'))->first();
        }

        // Generar el código de la nueva cuenta (esto dependerá de la lógica de tu aplicación)
        $newCode = $this->generateNewCode($parent ? $parent->code : null);

        // Crear la nueva cuenta
        $account = AccountCatalog::create([
            'code' => $newCode,
            'description' => $request->input('description'),
            'type_account' => $request->input('type_account'),
            'type_naturaled' => $request->input('type_naturaled'),
            'group' => $request->input('group'),
            'accept_transaction' => $parent ? 'N' : 'S', // Si tiene padre no acepta transacciones
        ]);

        // Si es una petición web, redirigir; si es API, devolver JSON
        if ($request->expectsJson()) {
            return response()->json($account, 201);
        }

        return redirect()->route('accounts.index')->with('success', 'Cuenta creada correctamente.');
    }

    /**
     * Método para generar el nuevo código basado en el código del padre.
     */
    private function generateNewCode($parentCode)
    {
        if (!$parentCode) {
            // Si no tiene padre, es la raíz, por ejemplo: 1000000000000
            return '1000000000000';
        }

        // Si el código padre tiene puntos, los removemos primero para mantener compatibilidad
        $cleanParentCode = str_replace('.', '', $parentCode);
        
        // Convertimos a número entero y incrementamos
        $parentNumber = (int)$cleanParentCode;
        $newNumber = $parentNumber + 1;
        
        // Retornamos el nuevo código como string, manteniendo la longitud con ceros a la izquierda
        return str_pad($newNumber, 13, '0', STR_PAD_LEFT);
    }

    /**
     * Mostrar una cuenta específica.
     */
    public function show($id)
    {
        $accounts = AccountCatalog::findOrFail($id);
        return response()->json($accounts, 200);
    }

    /**
     * Actualizar una cuenta existente.
     */
    public function update(Request $request, $id)
    {
        $account = AccountCatalog::findOrFail($id);
        $account->update($request->all());

        // Si es una petición web, redirigir; si es API, devolver JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Cuenta actualizada correctamente.',
                'account' => $account
            ], 200);
        }

        return redirect()->route('accounts.index')->with('success', 'Cuenta actualizada correctamente.');
    }

    /**
     * Mostrar la vista principal con todas las cuentas.
     */
    public function welcome(Request $request)
    {
        $perPage = $request->get('per_page', 15); // Por defecto 15 cuentas por página
        $search = $request->get('search'); // Para búsqueda opcional
        
        $query = AccountCatalog::orderBy('code');
        
        // Si hay búsqueda, filtrar por código o descripción
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $accounts = $query->paginate($perPage);
        
        return view('accounts.index', compact('accounts', 'search'));
    }

    /**
     * Mostrar la vista de edición.
     */
    public function edit($id)
    {
        $account = AccountCatalog::findOrFail($id);
        $parentAccounts = AccountCatalog::all();
        return view('accounts.edit', compact('account', 'parentAccounts'));
    }

    /**
     * Eliminar una cuenta existente.
     */
    public function destroy(Request $request, $id)
    {
        $account = AccountCatalog::findOrFail($id);
        $account->delete();

        // Si es una petición web, redirigir; si es API, devolver JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Cuenta eliminada correctamente.'
            ], 200);
        }

        return redirect()->route('accounts.index')->with('success', 'Cuenta eliminada correctamente.');
    }
}
