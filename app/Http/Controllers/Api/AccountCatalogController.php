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
    public function index()
    {
        $listAccounts = AccountCatalog::all();
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
            'accept_transaction' => $parent ? 'N' : 'Y', // Si tiene padre no acepta transacciones
        ]);

        return response()->json($account, 201);
    }

    /**
     * Método para generar el nuevo código basado en el código del padre.
     */
    private function generateNewCode($parentCode)
    {
        if (!$parentCode) {
            // Si no tiene padre, es la raíz, por ejemplo: 1.0.00.00.00.00.00
            return '1.0.00.00.00.00.00';
        }

        // Generamos el siguiente código incrementando el último segmento del código
        $segments = explode('.', $parentCode);
        $lastSegment = (int)end($segments);
        $segments[count($segments) - 1] = $lastSegment + 1;

        return implode('.', $segments);
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

        return response()->json([
            'message' => 'Cuenta actualizada correctamente.',
            'account' => $account
        ], 200);
    }

    /**
     * Eliminar una cuenta existente.
     */
    public function destroy($id)
    {
        $account = AccountCatalog::findOrFail($id);
        $account->delete();

        return response()->json([
            'message' => 'Cuenta eliminada correctamente.'
        ], 200);
    }
}
