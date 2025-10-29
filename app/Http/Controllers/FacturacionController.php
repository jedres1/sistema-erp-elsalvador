<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    /**
     * Mostrar el dashboard de facturación
     */
    public function index()
    {
        $estadisticas = $this->getEstadisticasFacturacion();
        $facturas_recientes = $this->getFacturasRecientes();
        
        return view('facturacion.index', compact('estadisticas', 'facturas_recientes'));
    }

    /**
     * Mostrar el formulario para crear una nueva factura
     */
    public function create()
    {
        $clientes = $this->getClientes();
        $productos = $this->getProductos();
        
        return view('facturacion.create', compact('clientes', 'productos'));
    }

    /**
     * Almacenar una nueva factura
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|integer',
            'fecha' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|integer',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio' => 'required|numeric|min:0',
        ]);

        // Aquí se guardaría la factura en la base de datos
        return redirect()->route('facturacion.index')
                         ->with('success', 'Factura creada exitosamente');
    }

    /**
     * Mostrar una factura específica
     */
    public function show($id)
    {
        $factura = $this->getFactura($id);
        
        if (!$factura) {
            abort(404);
        }
        
        return view('facturacion.show', compact('factura'));
    }

    /**
     * Mostrar el formulario para editar una factura
     */
    public function edit($id)
    {
        $factura = $this->getFactura($id);
        $clientes = $this->getClientes();
        $productos = $this->getProductos();
        
        if (!$factura) {
            abort(404);
        }
        
        return view('facturacion.edit', compact('factura', 'clientes', 'productos'));
    }

    /**
     * Actualizar una factura
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|integer',
            'fecha' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|integer',
            'items.*.cantidad' => 'required|numeric|min:1',
            'items.*.precio' => 'required|numeric|min:0',
        ]);

        // Aquí se actualizaría la factura en la base de datos
        return redirect()->route('facturacion.index')
                         ->with('success', 'Factura actualizada exitosamente');
    }

    /**
     * Eliminar una factura
     */
    public function destroy($id)
    {
        // Aquí se eliminaría la factura de la base de datos
        return redirect()->route('facturacion.index')
                         ->with('success', 'Factura eliminada exitosamente');
    }

    /**
     * Generar PDF de la factura
     */
    public function pdf($id)
    {
        $factura = $this->getFactura($id);
        
        if (!$factura) {
            abort(404);
        }
        
        // Aquí se generaría el PDF
        return response()->json(['message' => 'PDF generado exitosamente']);
    }

    /**
     * Obtener estadísticas de facturación
     */
    private function getEstadisticasFacturacion()
    {
        return [
            'total_mes' => 125000.00,
            'facturas_mes' => 45,
            'pendientes_cobro' => 23500.00,
            'clientes_activos' => 28
        ];
    }

    /**
     * Obtener facturas recientes
     */
    private function getFacturasRecientes()
    {
        return [
            [
                'id' => 1,
                'numero' => 'FAC-001',
                'cliente' => 'ABC Corporación',
                'fecha' => '2025-10-25',
                'total' => 5200.00,
                'estado' => 'pagada'
            ],
            [
                'id' => 2,
                'numero' => 'FAC-002',
                'cliente' => 'XYZ Empresa',
                'fecha' => '2025-10-24',
                'total' => 3800.00,
                'estado' => 'pendiente'
            ],
            [
                'id' => 3,
                'numero' => 'FAC-003',
                'cliente' => 'Servicios DEF',
                'fecha' => '2025-10-23',
                'total' => 2100.00,
                'estado' => 'vencida'
            ]
        ];
    }

    /**
     * Obtener lista de clientes
     */
    private function getClientes()
    {
        return [
            [
                'id' => 1, 
                'nombre' => 'ABC Corporación S.A. de C.V.', 
                'alias' => 'ABC Corp',
                'tipo_persona' => 'juridica',
                'nacionalidad' => 'nacional',
                'numero_identificacion' => '06071007921019',
                'actividad_economica' => 'Servicios de consultoría empresarial',
                'crn' => '123456789012345',
                'email' => 'contacto@abccorp.com',
                'telefono' => '2234-5678',
                'direccion_complementaria' => 'Av. Principal 123, Col. Centro, frente al Banco Central',
                'departamento' => 'san_salvador',
                'municipio' => 'san_salvador_centro',
                'distrito' => 'san_salvador',
                'limite_credito' => 50000.00,
                'dias_credito' => 30
            ],
            [
                'id' => 2, 
                'nombre' => 'María Elena García Rodríguez', 
                'alias' => 'María García',
                'tipo_persona' => 'natural',
                'nacionalidad' => 'nacional',
                'numero_identificacion' => '046463505',
                'actividad_economica' => '',
                'crn' => '',
                'email' => 'maria.garcia@gmail.com',
                'telefono' => '7234-5678',
                'direccion_complementaria' => 'Calle Las Flores 45, Col. San Benito, casa color azul',
                'departamento' => 'san_salvador',
                'municipio' => 'san_salvador_centro',
                'distrito' => 'mejicanos',
                'limite_credito' => 15000.00,
                'dias_credito' => 15
            ],
            [
                'id' => 3, 
                'nombre' => 'Servicios Profesionales DEF Ltda.', 
                'alias' => 'DEF Servicios',
                'tipo_persona' => 'juridica',
                'nacionalidad' => 'nacional',
                'numero_identificacion' => '06140314851234',
                'actividad_economica' => 'Servicios profesionales de contabilidad y auditoría',
                'crn' => '987654321098765',
                'email' => 'info@serviciosdef.com',
                'telefono' => '2345-6789',
                'direccion_complementaria' => 'Boulevard Los Héroes 789, Edificio Torre Empresarial, Oficina 502',
                'departamento' => 'san_salvador',
                'municipio' => 'san_salvador_este',
                'distrito' => 'soyapango',
                'limite_credito' => 25000.00,
                'dias_credito' => 45
            ],
            [
                'id' => 4, 
                'nombre' => 'John Michael Smith', 
                'alias' => 'John Smith',
                'tipo_persona' => 'natural',
                'nacionalidad' => 'extranjero',
                'numero_identificacion' => 'US123456789',
                'actividad_economica' => '',
                'crn' => '',
                'email' => 'john.smith@email.com',
                'telefono' => '2234-1234',
                'direccion_complementaria' => 'Zona Rosa, Edificio Plaza 301, Apartamento 15-B',
                'departamento' => 'san_salvador',
                'municipio' => 'san_salvador_centro',
                'distrito' => 'san_salvador',
                'limite_credito' => 20000.00,
                'dias_credito' => 30
            ],
            [
                'id' => 5, 
                'nombre' => 'Comercial Santa Ana S.A.', 
                'alias' => 'Comercial STA',
                'tipo_persona' => 'juridica',
                'nacionalidad' => 'nacional',
                'numero_identificacion' => '02140315961234',
                'actividad_economica' => 'Comercio al por mayor de productos alimenticios',
                'crn' => '567890123456789',
                'email' => 'ventas@comercialsantaana.com',
                'telefono' => '2440-5555',
                'direccion_complementaria' => 'Centro Comercial Santa Ana Plaza, Local 25',
                'departamento' => 'santa_ana',
                'municipio' => 'santa_ana_centro',
                'distrito' => 'santa_ana',
                'limite_credito' => 75000.00,
                'dias_credito' => 60
            ],
            [
                'id' => 6, 
                'nombre' => 'José Roberto Martínez', 
                'alias' => 'Roberto Martínez',
                'tipo_persona' => 'natural',
                'nacionalidad' => 'nacional',
                'numero_identificacion' => '012345678',
                'actividad_economica' => '',
                'crn' => '',
                'email' => 'roberto.martinez@email.com',
                'telefono' => '2420-7890',
                'direccion_complementaria' => 'Barrio El Centro, Calle Principal 567',
                'departamento' => 'ahuachapan',
                'municipio' => 'ahuachapan_centro',
                'distrito' => 'ahuachapan',
                'limite_credito' => 10000.00,
                'dias_credito' => 15
            ]
        ];
    }

    /**
     * Obtener lista de productos/servicios
     */
    private function getProductos()
    {
        return [
            ['id' => 1, 'nombre' => 'Consultoría Contable', 'precio' => 1500.00],
            ['id' => 2, 'nombre' => 'Auditoría Financiera', 'precio' => 2500.00],
            ['id' => 3, 'nombre' => 'Declaración Fiscal', 'precio' => 800.00]
        ];
    }

    /**
     * Obtener una factura específica
     */
    private function getFactura($id)
    {
        $facturas = $this->getFacturasRecientes();
        return collect($facturas)->firstWhere('id', (int)$id);
    }

    /**
     * Generar PDF de la factura
     */
    public function generarPdf($id)
    {
        $factura = $this->getFactura($id);
        
        if (!$factura) {
            return redirect()->route('facturacion.index')
                           ->with('error', 'Factura no encontrada');
        }

        // Simular datos completos de la factura para el PDF
        $facturaCompleta = [
            'id' => $factura['id'],
            'numero' => $factura['numero'],
            'fecha' => $factura['fecha'],
            'cliente' => [
                'nombre' => $factura['cliente'],
                'rfc' => 'ABC123456789',
                'direccion' => 'Av. Principal 123, Col. Centro, Ciudad, Estado, 12345',
                'telefono' => '+52 55 1234 5678',
                'email' => 'cliente@email.com'
            ],
            'empresa' => [
                'nombre' => 'Mi Empresa S.A. de C.V.',
                'rfc' => 'EMP987654321',
                'direccion' => 'Calle Empresa 456, Col. Industrial, Ciudad, Estado, 54321',
                'telefono' => '+52 55 9876 5432',
                'email' => 'ventas@miempresa.com'
            ],
            'conceptos' => [
                [
                    'cantidad' => 2,
                    'descripcion' => 'Consultoría Empresarial',
                    'precio_unitario' => 5000.00,
                    'importe' => 10000.00
                ],
                [
                    'cantidad' => 1,
                    'descripcion' => 'Capacitación Especializada',
                    'precio_unitario' => 3000.00,
                    'importe' => 3000.00
                ]
            ],
            'subtotal' => 13000.00,
            'iva' => 2080.00,
            'total' => $factura['total'],
            'estado' => $factura['estado'],
            'fecha_vencimiento' => date('Y-m-d', strtotime($factura['fecha'] . ' +30 days'))
        ];

        // En un entorno real, aquí se generaría el PDF con una librería como DomPDF o TCPDF
        // Por ahora, retornamos una vista que simula el PDF
        return view('facturacion.pdf', compact('facturaCompleta'));
    }
}