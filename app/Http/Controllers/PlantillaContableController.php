<?php

namespace App\Http\Controllers;

use App\Models\PlantillaContable;
use App\Models\PlantillaContableCuenta;
use App\Models\AccountCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantillaContableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PlantillaContable::with('cuentas.cuenta');

        // Filtrar por tipo si se proporciona
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtrar por estado
        if ($request->filled('estado')) {
            $query->where('activo', $request->estado === 'activo');
        }

        // Búsqueda por nombre
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $plantillas = $query->latest()->paginate(15);

        return view('plantillas-contables.index', compact('plantillas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cuentasContables = AccountCatalog::where('accept_transaction', 'S')
            ->orderBy('code')
            ->get();

        return view('plantillas-contables.create', compact('cuentasContables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|in:cliente,articulo,proveedor',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean',
            'cuentas' => 'array',
            'cuentas.*.tipo_cuenta' => 'required|string',
            'cuentas.*.account_catalog_id' => 'required|exists:account_catalogs,id'
        ]);

        try {
            DB::beginTransaction();

            $plantilla = PlantillaContable::create([
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'activo' => $request->has('activo') ? true : false
            ]);

            // Guardar las cuentas asociadas
            if ($request->has('cuentas')) {
                foreach ($request->cuentas as $cuenta) {
                    PlantillaContableCuenta::create([
                        'plantilla_contable_id' => $plantilla->id,
                        'account_catalog_id' => $cuenta['account_catalog_id'],
                        'tipo_cuenta' => $cuenta['tipo_cuenta']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('plantillas-contables.index')
                ->with('success', 'Plantilla contable creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al crear la plantilla: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PlantillaContable $plantillasContable)
    {
        $plantillasContable->load('cuentas.cuenta');
        return view('plantillas-contables.show', compact('plantillasContable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlantillaContable $plantillasContable)
    {
        $plantillasContable->load('cuentas.cuenta');
        
        $cuentasContables = AccountCatalog::where('accept_transaction', 'S')
            ->orderBy('code')
            ->get();

        return view('plantillas-contables.edit', compact('plantillasContable', 'cuentasContables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlantillaContable $plantillasContable)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|in:cliente,articulo,proveedor',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean',
            'cuentas' => 'array',
            'cuentas.*.tipo_cuenta' => 'required|string',
            'cuentas.*.account_catalog_id' => 'required|exists:account_catalogs,id'
        ]);

        try {
            DB::beginTransaction();

            $plantillasContable->update([
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'activo' => $request->has('activo') ? true : false
            ]);

            // Eliminar cuentas anteriores y crear las nuevas
            $plantillasContable->cuentas()->delete();

            if ($request->has('cuentas')) {
                foreach ($request->cuentas as $cuenta) {
                    PlantillaContableCuenta::create([
                        'plantilla_contable_id' => $plantillasContable->id,
                        'account_catalog_id' => $cuenta['account_catalog_id'],
                        'tipo_cuenta' => $cuenta['tipo_cuenta']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('plantillas-contables.index')
                ->with('success', 'Plantilla contable actualizada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al actualizar la plantilla: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlantillaContable $plantillasContable)
    {
        try {
            $plantillasContable->delete();
            return redirect()->route('plantillas-contables.index')
                ->with('success', 'Plantilla contable eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la plantilla: ' . $e->getMessage());
        }
    }
}
