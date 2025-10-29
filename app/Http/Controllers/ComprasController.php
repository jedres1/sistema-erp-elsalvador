<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasController extends Controller
{
    /**
     * Mostrar el dashboard de compras
     */
    public function index()
    {
        $compras = $this->getCompras();
        $estadisticas = $this->getEstadisticasCompras();
        $ordenes_pendientes = $this->getOrdenesPendientes();
        
        return view('compras.index', compact('compras', 'estadisticas', 'ordenes_pendientes'));
    }

    /**
     * Mostrar el formulario para crear una nueva orden de compra
     */
    public function create()
    {
        $proveedores = $this->getProveedores();
        $productos = $this->getProductos();
        
        return view('compras.create', compact('proveedores', 'productos'));
    }

    /**
     * Almacenar una nueva orden de compra
     */
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|integer',
            'fecha_orden' => 'required|date',
            'fecha_entrega' => 'required|date|after_or_equal:fecha_orden',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|integer',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Aquí se guardaría la orden de compra en la base de datos
        return redirect()->route('compras.index')
                         ->with('success', 'Orden de compra creada exitosamente');
    }

    /**
     * Mostrar una orden de compra específica
     */
    public function show($id)
    {
        $compra = $this->getCompra($id);
        
        if (!$compra) {
            abort(404);
        }
        
        return view('compras.show', compact('compra'));
    }

    /**
     * Mostrar el formulario para editar una orden de compra
     */
    public function edit($id)
    {
        $compra = $this->getCompra($id);
        $proveedores = $this->getProveedores();
        $productos = $this->getProductos();
        
        if (!$compra) {
            abort(404);
        }
        
        return view('compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Actualizar una orden de compra
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'proveedor_id' => 'required|integer',
            'fecha_orden' => 'required|date',
            'fecha_entrega' => 'required|date|after_or_equal:fecha_orden',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|integer',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Aquí se actualizaría la orden de compra en la base de datos
        return redirect()->route('compras.index')
                         ->with('success', 'Orden de compra actualizada exitosamente');
    }

    /**
     * Eliminar una orden de compra
     */
    public function destroy($id)
    {
        // Aquí se eliminaría la orden de compra de la base de datos
        return redirect()->route('compras.index')
                         ->with('success', 'Orden de compra eliminada exitosamente');
    }

    /**
     * Marcar orden como recibida
     */
    public function recibir($id)
    {
        // Aquí se marcaría la orden como recibida y se actualizaría el inventario
        return redirect()->route('compras.index')
                         ->with('success', 'Orden marcada como recibida');
    }

    /**
     * Aprobar orden de compra
     */
    public function aprobar($id)
    {
        // Aquí se aprobaría la orden de compra
        return redirect()->route('compras.index')
                         ->with('success', 'Orden de compra aprobada');
    }

    /**
     * Cancelar orden de compra
     */
    public function cancelar($id)
    {
        // Aquí se cancelaría la orden de compra
        return redirect()->route('compras.index')
                         ->with('success', 'Orden de compra cancelada');
    }

    /**
     * Obtener lista de compras/órdenes
     */
    private function getCompras()
    {
        return [
            [
                'id' => 1,
                'numero_orden' => 'OC-001',
                'proveedor' => 'Proveedor Tech SA',
                'fecha_orden' => '2025-10-20',
                'fecha_entrega' => '2025-10-27',
                'total' => 25000.00,
                'estado' => 'pendiente',
                'items_count' => 3
            ],
            [
                'id' => 2,
                'numero_orden' => 'OC-002',
                'proveedor' => 'Distribuidora XYZ',
                'fecha_orden' => '2025-10-18',
                'fecha_entrega' => '2025-10-25',
                'total' => 15500.00,
                'estado' => 'aprobada',
                'items_count' => 2
            ],
            [
                'id' => 3,
                'numero_orden' => 'OC-003',
                'proveedor' => 'Importadora ABC',
                'fecha_orden' => '2025-10-15',
                'fecha_entrega' => '2025-10-22',
                'total' => 42000.00,
                'estado' => 'recibida',
                'items_count' => 5
            ]
        ];
    }

    /**
     * Obtener estadísticas de compras
     */
    private function getEstadisticasCompras()
    {
        return [
            'total_mes' => 85000.00,
            'ordenes_pendientes' => 5,
            'ordenes_vencidas' => 2,
            'proveedores_activos' => 12
        ];
    }

    /**
     * Obtener órdenes pendientes
     */
    private function getOrdenesPendientes()
    {
        return [
            [
                'numero_orden' => 'OC-001',
                'proveedor' => 'Proveedor Tech SA',
                'total' => 25000.00,
                'dias_restantes' => 2
            ],
            [
                'numero_orden' => 'OC-004',
                'proveedor' => 'Suministros DEF',
                'total' => 8500.00,
                'dias_restantes' => -1 // Vencida
            ]
        ];
    }

    /**
     * Obtener proveedores
     */
    private function getProveedores()
    {
        return [
            [
                'id' => 1,
                'nombre' => 'Proveedor Tech SA',
                'rfc' => 'PTE123456789',
                'contacto' => 'Juan Pérez',
                'telefono' => '555-1234'
            ],
            [
                'id' => 2,
                'nombre' => 'Distribuidora XYZ',
                'rfc' => 'DXY987654321',
                'contacto' => 'María González',
                'telefono' => '555-5678'
            ],
            [
                'id' => 3,
                'nombre' => 'Importadora ABC',
                'rfc' => 'IAB456789123',
                'contacto' => 'Carlos Rodríguez',
                'telefono' => '555-9012'
            ]
        ];
    }

    /**
     * Obtener productos disponibles para compra
     */
    private function getProductos()
    {
        return [
            [
                'id' => 1,
                'codigo' => 'PROD001',
                'nombre' => 'Laptop Dell Inspiron',
                'precio_sugerido' => 12000.00,
                'stock_actual' => 15
            ],
            [
                'id' => 2,
                'codigo' => 'PROD002',
                'nombre' => 'Mouse Inalámbrico',
                'precio_sugerido' => 250.00,
                'stock_actual' => 3
            ],
            [
                'id' => 3,
                'codigo' => 'PROD003',
                'nombre' => 'Monitor 24 pulgadas',
                'precio_sugerido' => 3500.00,
                'stock_actual' => 0
            ]
        ];
    }

    /**
     * Obtener una compra específica
     */
    private function getCompra($id)
    {
        $compras = $this->getCompras();
        $compra = collect($compras)->firstWhere('id', (int)$id);
        
        if ($compra) {
            // Agregar detalles de items para la vista
            $compra['items'] = [
                [
                    'producto' => 'Laptop Dell Inspiron',
                    'cantidad' => 5,
                    'precio_unitario' => 12000.00,
                    'subtotal' => 60000.00
                ],
                [
                    'producto' => 'Monitor 24 pulgadas',
                    'cantidad' => 3,
                    'precio_unitario' => 3500.00,
                    'subtotal' => 10500.00
                ]
            ];
        }
        
        return $compra;
    }
}