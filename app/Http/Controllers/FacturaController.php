<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Services\PartidaContableService;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    protected $partidaService;

    public function __construct(PartidaContableService $partidaService)
    {
        $this->partidaService = $partidaService;
    }

    /**
     * Mostrar formulario de facturación
     */
    public function create()
    {
        // Obtener clientes activos de la base de datos
        $clientes = Cliente::where('estado', 'A')
                          ->orderBy('nombre', 'asc')
                          ->get();

        // Obtener productos activos de la base de datos
        $productos = Producto::where('estado', 'A')
                            ->orderBy('nombre', 'asc')
                            ->get();

        return view('facturas.create', compact('clientes', 'productos'));
    }

    /**
     * Guardar factura y generar partida contable automáticamente
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'fecha' => 'required|date',
                'descripcion' => 'nullable|string',
                'items' => 'required|array|min:1',
                'items.*.producto_id' => 'required|exists:productos,id',
                'items.*.cantidad' => 'required|numeric|min:0.01',
                'items.*.precio_unitario' => 'required|numeric|min:0'
            ]);

            // Generar descripción automática si no se proporciona
            if (empty($validated['descripcion'])) {
                $cliente = Cliente::find($validated['cliente_id']);
                $validated['descripcion'] = "Factura de venta a {$cliente->nombre}";
            }

            // Generar la partida contable automáticamente
            $partida = $this->partidaService->generarPartidaDesdeFactura($validated);

            return redirect()->route('journal.index')
                ->with('success', "✅ Factura registrada exitosamente. Partida contable #{$partida->id} generada (pendiente de mayorizar).");
                
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', '❌ Error al procesar la factura: ' . $e->getMessage());
        }
    }

    /**
     * API para obtener datos del producto
     */
    public function getProducto($id)
    {
        try {
            $producto = Producto::with('plantillaContable.cuentas.cuenta')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'producto' => [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'descripcion' => $producto->descripcion,
                    'precio_venta' => $producto->precio_venta,
                    'precio_compra' => $producto->precio_compra,
                    'existencia' => $producto->existencia,
                    'maneja_inventario' => $producto->maneja_inventario,
                    'tiene_plantilla' => $producto->plantillaContable ? true : false,
                    'plantilla_nombre' => $producto->plantillaContable ? $producto->plantillaContable->nombre : null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
