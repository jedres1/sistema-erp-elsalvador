<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Mostrar el dashboard de inventario
     */
    public function index()
    {
        $productos = $this->getProductos();
        $estadisticas = $this->getEstadisticasInventario();
        $alertas = $this->getAlertasInventario();
        
        return view('inventario.index', compact('productos', 'estadisticas', 'alertas'));
    }

    /**
     * Mostrar el formulario para crear un nuevo producto
     */
    public function create()
    {
        $categorias = $this->getCategorias();
        $proveedores = $this->getProveedores();
        
        return view('inventario.create', compact('categorias', 'proveedores'));
    }

    /**
     * Almacenar un nuevo producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:productos,codigo',
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|integer',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_actual' => 'required|integer|min:0',
        ]);

        // Aquí se guardaría el producto en la base de datos
        return redirect()->route('inventario.index')
                         ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Mostrar un producto específico
     */
    public function show($id)
    {
        $producto = $this->getProducto($id);
        $movimientos = $this->getMovimientosProducto($id);
        
        if (!$producto) {
            abort(404);
        }
        
        return view('inventario.show', compact('producto', 'movimientos'));
    }

    /**
     * Mostrar el formulario para editar un producto
     */
    public function edit($id)
    {
        $producto = $this->getProducto($id);
        $categorias = $this->getCategorias();
        $proveedores = $this->getProveedores();
        
        if (!$producto) {
            abort(404);
        }
        
        return view('inventario.edit', compact('producto', 'categorias', 'proveedores'));
    }

    /**
     * Actualizar un producto
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|string',
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|integer',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_actual' => 'required|integer|min:0',
        ]);

        // Aquí se actualizaría el producto en la base de datos
        return redirect()->route('inventario.index')
                         ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar un producto
     */
    public function destroy($id)
    {
        // Aquí se eliminaría el producto de la base de datos
        return redirect()->route('inventario.index')
                         ->with('success', 'Producto eliminado exitosamente');
    }

    /**
     * Registrar entrada de inventario
     */
    public function entrada(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'proveedor_id' => 'required|integer',
            'observaciones' => 'nullable|string'
        ]);

        // Aquí se registraría la entrada de inventario
        return redirect()->route('inventario.index')
                         ->with('success', 'Entrada de inventario registrada exitosamente');
    }

    /**
     * Registrar salida de inventario
     */
    public function salida(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string',
            'observaciones' => 'nullable|string'
        ]);

        // Aquí se registraría la salida de inventario
        return redirect()->route('inventario.index')
                         ->with('success', 'Salida de inventario registrada exitosamente');
    }

    /**
     * Obtener lista de productos
     */
    private function getProductos()
    {
        return [
            [
                'id' => 1,
                'codigo' => 'PROD001',
                'nombre' => 'Laptop Dell Inspiron',
                'categoria' => 'Tecnología',
                'stock_actual' => 15,
                'stock_minimo' => 5,
                'precio_compra' => 12000.00,
                'precio_venta' => 15000.00,
                'estado' => 'normal'
            ],
            [
                'id' => 2,
                'codigo' => 'PROD002',
                'nombre' => 'Mouse Inalámbrico',
                'categoria' => 'Accesorios',
                'stock_actual' => 3,
                'stock_minimo' => 10,
                'precio_compra' => 250.00,
                'precio_venta' => 350.00,
                'estado' => 'bajo'
            ],
            [
                'id' => 3,
                'codigo' => 'PROD003',
                'nombre' => 'Monitor 24 pulgadas',
                'categoria' => 'Tecnología',
                'stock_actual' => 0,
                'stock_minimo' => 3,
                'precio_compra' => 3500.00,
                'precio_venta' => 4500.00,
                'estado' => 'agotado'
            ]
        ];
    }

    /**
     * Obtener estadísticas de inventario
     */
    private function getEstadisticasInventario()
    {
        return [
            'total_productos' => 156,
            'valor_inventario' => 1250000.00,
            'productos_bajo_stock' => 8,
            'productos_agotados' => 3
        ];
    }

    /**
     * Obtener alertas de inventario
     */
    private function getAlertasInventario()
    {
        return [
            ['tipo' => 'agotado', 'producto' => 'Monitor 24 pulgadas', 'stock' => 0],
            ['tipo' => 'bajo_stock', 'producto' => 'Mouse Inalámbrico', 'stock' => 3],
            ['tipo' => 'bajo_stock', 'producto' => 'Teclado Mecánico', 'stock' => 2]
        ];
    }

    /**
     * Obtener categorías
     */
    private function getCategorias()
    {
        return [
            ['id' => 1, 'nombre' => 'Tecnología'],
            ['id' => 2, 'nombre' => 'Accesorios'],
            ['id' => 3, 'nombre' => 'Oficina']
        ];
    }

    /**
     * Obtener proveedores
     */
    private function getProveedores()
    {
        return [
            ['id' => 1, 'nombre' => 'Proveedor Tech SA'],
            ['id' => 2, 'nombre' => 'Distribuidora XYZ'],
            ['id' => 3, 'nombre' => 'Importadora ABC']
        ];
    }

    /**
     * Obtener un producto específico
     */
    private function getProducto($id)
    {
        $productos = $this->getProductos();
        return collect($productos)->firstWhere('id', (int)$id);
    }

    /**
     * Obtener movimientos de un producto específico
     */
    private function getMovimientosProducto($id)
    {
        return [
            [
                'fecha' => '2025-10-25',
                'tipo' => 'entrada',
                'cantidad' => 10,
                'motivo' => 'Compra a proveedor',
                'usuario' => 'Admin'
            ],
            [
                'fecha' => '2025-10-24',
                'tipo' => 'salida',
                'cantidad' => 2,
                'motivo' => 'Venta',
                'usuario' => 'Vendedor1'
            ]
        ];
    }

    /**
     * Mostrar el reporte Kardex
     */
    public function kardex(Request $request)
    {
        $productos = $this->getProductos();
        $productoSeleccionado = $request->get('producto_id');
        $fechaDesde = $request->get('fecha_desde', date('Y-m-01'));
        $fechaHasta = $request->get('fecha_hasta', date('Y-m-d'));
        
        $movimientosKardex = [];
        
        if ($productoSeleccionado) {
            $movimientosKardex = $this->getMovimientosKardex($productoSeleccionado, $fechaDesde, $fechaHasta);
        }
        
        return view('inventario.kardex', compact('productos', 'productoSeleccionado', 'fechaDesde', 'fechaHasta', 'movimientosKardex'));
    }

    /**
     * Obtener movimientos Kardex de un producto
     */
    private function getMovimientosKardex($productoId, $fechaDesde, $fechaHasta)
    {
        // Simulamos datos del Kardex con entradas, salidas y saldos
        return [
            [
                'fecha' => '2025-10-01',
                'documento' => 'INV-001',
                'concepto' => 'Inventario Inicial',
                'entrada_cantidad' => 100,
                'entrada_costo' => 50.00,
                'entrada_total' => 5000.00,
                'salida_cantidad' => 0,
                'salida_costo' => 0,
                'salida_total' => 0,
                'saldo_cantidad' => 100,
                'saldo_costo' => 50.00,
                'saldo_total' => 5000.00
            ],
            [
                'fecha' => '2025-10-05',
                'documento' => 'COM-001',
                'concepto' => 'Compra a Proveedor ABC',
                'entrada_cantidad' => 50,
                'entrada_costo' => 52.00,
                'entrada_total' => 2600.00,
                'salida_cantidad' => 0,
                'salida_costo' => 0,
                'salida_total' => 0,
                'saldo_cantidad' => 150,
                'saldo_costo' => 50.67,
                'saldo_total' => 7600.00
            ],
            [
                'fecha' => '2025-10-10',
                'documento' => 'FAC-001',
                'concepto' => 'Venta Cliente XYZ',
                'entrada_cantidad' => 0,
                'entrada_costo' => 0,
                'entrada_total' => 0,
                'salida_cantidad' => 20,
                'salida_costo' => 50.67,
                'salida_total' => 1013.40,
                'saldo_cantidad' => 130,
                'saldo_costo' => 50.67,
                'saldo_total' => 6586.60
            ],
            [
                'fecha' => '2025-10-15',
                'documento' => 'COM-002',
                'concepto' => 'Compra a Proveedor DEF',
                'entrada_cantidad' => 30,
                'entrada_costo' => 48.00,
                'entrada_total' => 1440.00,
                'salida_cantidad' => 0,
                'salida_costo' => 0,
                'salida_total' => 0,
                'saldo_cantidad' => 160,
                'saldo_costo' => 50.17,
                'saldo_total' => 8026.60
            ],
            [
                'fecha' => '2025-10-20',
                'documento' => 'FAC-002',
                'concepto' => 'Venta Cliente ABC',
                'entrada_cantidad' => 0,
                'entrada_costo' => 0,
                'entrada_total' => 0,
                'salida_cantidad' => 15,
                'salida_costo' => 50.17,
                'salida_total' => 752.55,
                'saldo_cantidad' => 145,
                'saldo_costo' => 50.17,
                'saldo_total' => 7274.05
            ],
            [
                'fecha' => '2025-10-25',
                'documento' => 'AJS-001',
                'concepto' => 'Ajuste por Inventario Físico',
                'entrada_cantidad' => 0,
                'entrada_costo' => 0,
                'entrada_total' => 0,
                'salida_cantidad' => 3,
                'salida_costo' => 50.17,
                'salida_total' => 150.51,
                'saldo_cantidad' => 142,
                'saldo_costo' => 50.17,
                'saldo_total' => 7123.54
            ]
        ];
    }
}