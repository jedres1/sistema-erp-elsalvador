<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuentasPorCobrarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Simulamos datos de cuentas por cobrar
        $cuentasPorCobrar = [
            [
                'id' => 1,
                'numero_factura' => 'FE-2024-001',
                'cliente' => 'Empresa ABC S.A. de C.V.',
                'fecha_emision' => '2024-10-15',
                'fecha_vencimiento' => '2024-11-15',
                'monto_original' => 15800.00,
                'monto_pagado' => 5000.00,
                'saldo_pendiente' => 10800.00,
                'estado' => 'Parcial',
                'dias_vencido' => 0,
                'documento_tipo' => 'Factura Electrónica'
            ],
            [
                'id' => 2,
                'numero_factura' => 'FE-2024-002',
                'cliente' => 'Comercial XYZ Ltda.',
                'fecha_emision' => '2024-09-20',
                'fecha_vencimiento' => '2024-10-20',
                'monto_original' => 8750.00,
                'monto_pagado' => 0.00,
                'saldo_pendiente' => 8750.00,
                'estado' => 'Vencida',
                'dias_vencido' => 9,
                'documento_tipo' => 'Factura Electrónica'
            ],
            [
                'id' => 3,
                'numero_factura' => 'FE-2024-003',
                'cliente' => 'Servicios Profesionales MNO',
                'fecha_emision' => '2024-10-25',
                'fecha_vencimiento' => '2024-12-25',
                'monto_original' => 12500.00,
                'monto_pagado' => 0.00,
                'saldo_pendiente' => 12500.00,
                'estado' => 'Pendiente',
                'dias_vencido' => 0,
                'documento_tipo' => 'Factura Electrónica'
            ],
            [
                'id' => 4,
                'numero_factura' => 'FE-2024-004',
                'cliente' => 'Transportes DEF S.A.',
                'fecha_emision' => '2024-08-15',
                'fecha_vencimiento' => '2024-09-15',
                'monto_original' => 6200.00,
                'monto_pagado' => 6200.00,
                'saldo_pendiente' => 0.00,
                'estado' => 'Pagada',
                'dias_vencido' => 0,
                'documento_tipo' => 'Factura Electrónica'
            ]
        ];

        // Estadísticas del módulo
        $estadisticas = [
            'total_por_cobrar' => array_sum(array_column($cuentasPorCobrar, 'saldo_pendiente')),
            'total_vencido' => array_sum(array_column(array_filter($cuentasPorCobrar, function($cuenta) {
                return $cuenta['estado'] === 'Vencida';
            }), 'saldo_pendiente')),
            'total_al_dia' => array_sum(array_column(array_filter($cuentasPorCobrar, function($cuenta) {
                return $cuenta['estado'] === 'Pendiente';
            }), 'saldo_pendiente')),
            'facturas_pendientes' => count(array_filter($cuentasPorCobrar, function($cuenta) {
                return $cuenta['saldo_pendiente'] > 0;
            })),
            'facturas_vencidas' => count(array_filter($cuentasPorCobrar, function($cuenta) {
                return $cuenta['estado'] === 'Vencida';
            })),
            'promedio_dias_cobro' => 25
        ];

        return view('cuentas-por-cobrar.index', compact('cuentasPorCobrar', 'estadisticas'));
    }

    /**
     * Mostrar detalles de una cuenta por cobrar específica
     */
    public function show($id)
    {
        // Simular datos de la cuenta específica
        $cuenta = [
            'id' => $id,
            'numero_factura' => 'FE-2024-001',
            'cliente' => 'Empresa ABC S.A. de C.V.',
            'cliente_documento' => '1234567890123',
            'fecha_emision' => '2024-10-15',
            'fecha_vencimiento' => '2024-11-15',
            'monto_original' => 15800.00,
            'monto_pagado' => 5000.00,
            'saldo_pendiente' => 10800.00,
            'estado' => 'Parcial',
            'dias_vencido' => 0,
            'documento_tipo' => 'Factura Electrónica',
            'observaciones' => 'Cliente con historial de pago regular'
        ];

        // Historial de pagos
        $historialPagos = [
            [
                'id' => 1,
                'fecha_pago' => '2024-10-20',
                'monto' => 5000.00,
                'metodo_pago' => 'Transferencia Bancaria',
                'referencia' => 'TRF-2024-1001',
                'observaciones' => 'Pago parcial recibido'
            ]
        ];

        return view('cuentas-por-cobrar.show', compact('cuenta', 'historialPagos'));
    }

    /**
     * Registrar un pago
     */
    public function registrarPago(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0.01',
            'fecha_pago' => 'required|date',
            'metodo_pago' => 'required|string',
            'referencia' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string|max:500'
        ]);

        // Aquí se implementaría la lógica para registrar el pago
        // Por ahora simularemos el proceso

        return redirect()->route('cuentas-por-cobrar.show', $id)
                        ->with('success', 'Pago registrado exitosamente');
    }

    /**
     * Generar reporte de antigüedad de saldos
     */
    public function reporteAntiguedad()
    {
        $reporteAntiguedad = [
            'corriente' => ['monto' => 12500.00, 'facturas' => 1],
            'de_1_a_30' => ['monto' => 10800.00, 'facturas' => 1],
            'de_31_a_60' => ['monto' => 0.00, 'facturas' => 0],
            'de_61_a_90' => ['monto' => 0.00, 'facturas' => 0],
            'mas_de_90' => ['monto' => 8750.00, 'facturas' => 1]
        ];

        return view('cuentas-por-cobrar.reporte-antiguedad', compact('reporteAntiguedad'));
    }

    /**
     * Exportar reporte a Excel
     */
    public function exportarExcel()
    {
        // Simular exportación
        return redirect()->route('cuentas-por-cobrar.index')
                        ->with('success', 'Reporte exportado exitosamente');
    }

    /**
     * Enviar recordatorio de pago
     */
    public function enviarRecordatorio($id)
    {
        // Simular envío de recordatorio
        return redirect()->route('cuentas-por-cobrar.show', $id)
                        ->with('success', 'Recordatorio de pago enviado exitosamente');
    }

    /**
     * ========================================
     * GESTIÓN DE PROVEEDORES
     * ========================================
     */

    /**
     * Display a listing of proveedores.
     */
    public function proveedoresIndex()
    {
        // Simulamos datos de proveedores
        $proveedores = [
            [
                'id' => 1,
                'numero_documento' => '9876543210987',
                'tipo_documento' => 'NIT',
                'razon_social' => 'Distribuidora El Salvador S.A.',
                'nombre_comercial' => 'Distribuidora ES',
                'telefono' => '2234-5678',
                'email' => 'ventas@distribuidoraes.com',
                'direccion' => 'Av. Roosevelt #123, San Salvador',
                'departamento' => 'San Salvador',
                'municipio' => 'San Salvador Centro',
                'distrito' => 'San Salvador',
                'limite_credito' => 50000.00,
                'credito_disponible' => 35000.00,
                'estado' => 'Activo',
                'fecha_registro' => '2024-01-15 08:30:00'
            ],
            [
                'id' => 2,
                'numero_documento' => '1234567890123',
                'tipo_documento' => 'NIT',
                'razon_social' => 'Servicios Técnicos Profesionales S.A.',
                'nombre_comercial' => 'Servicios Tech',
                'telefono' => '2345-6789',
                'email' => 'info@serviciostech.com',
                'direccion' => 'Col. Escalón, Calle Los Bambúes #456',
                'departamento' => 'San Salvador',
                'municipio' => 'San Salvador Centro',
                'distrito' => 'San Salvador',
                'limite_credito' => 25000.00,
                'credito_disponible' => 25000.00,
                'estado' => 'Activo',
                'fecha_registro' => '2024-02-20 14:15:00'
            ],
            [
                'id' => 3,
                'numero_documento' => '5678901234567',
                'tipo_documento' => 'NIT',
                'razon_social' => 'Suministros Industriales del Pacífico',
                'nombre_comercial' => 'SumPac',
                'telefono' => '2456-7890',
                'email' => 'compras@sumpac.com',
                'direccion' => 'Zona Industrial, Soyapango',
                'departamento' => 'San Salvador',
                'municipio' => 'San Salvador Este',
                'distrito' => 'Soyapango',
                'limite_credito' => 75000.00,
                'credito_disponible' => 40000.00,
                'estado' => 'Activo',
                'fecha_registro' => '2024-03-10 10:45:00'
            ],
            [
                'id' => 4,
                'numero_documento' => '0123456789012',
                'tipo_documento' => 'DUI',
                'razon_social' => 'María Elena Vásquez',
                'nombre_comercial' => 'Consultoría MEV',
                'telefono' => '7567-8901',
                'email' => 'mvasquez@consultoriamev.com',
                'direccion' => 'Res. Santa Mónica, Casa #89',
                'departamento' => 'La Libertad',
                'municipio' => 'La Libertad Este',
                'distrito' => 'Antiguo Cuscatlán',
                'limite_credito' => 15000.00,
                'credito_disponible' => 12000.00,
                'estado' => 'Activo',
                'fecha_registro' => '2024-04-05 16:20:00'
            ]
        ];

        return view('cuentas-por-cobrar.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new proveedor.
     */
    public function proveedoresCreate()
    {
        return view('cuentas-por-cobrar.proveedores.create');
    }

    /**
     * Store a newly created proveedor.
     */
    public function proveedoresStore(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string|max:20',
            'tipo_documento' => 'required|in:DUI,NIT,PASAPORTE,CARNET_EXTRANJERIA',
            'razon_social' => 'required|string|max:255',
            'nombre_comercial' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:500',
            'departamento' => 'nullable|string|max:100',
            'municipio' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100',
            'limite_credito' => 'nullable|numeric|min:0'
        ]);

        // Aquí se implementaría la lógica para guardar en la base de datos
        // Por ahora simularemos el proceso

        return redirect()->route('cuentas-por-cobrar.proveedores.index')
                        ->with('success', 'Proveedor creado exitosamente');
    }

    /**
     * Display the specified proveedor.
     */
    public function proveedoresShow($id)
    {
        // Simular datos del proveedor específico
        $proveedor = [
            'id' => $id,
            'numero_documento' => '9876543210987',
            'tipo_documento' => 'NIT',
            'razon_social' => 'Distribuidora El Salvador S.A.',
            'nombre_comercial' => 'Distribuidora ES',
            'telefono' => '2234-5678',
            'email' => 'ventas@distribuidoraes.com',
            'direccion' => 'Av. Roosevelt #123, San Salvador',
            'departamento' => 'San Salvador',
            'municipio' => 'San Salvador Centro',
            'distrito' => 'San Salvador',
            'limite_credito' => 50000.00,
            'credito_disponible' => 35000.00,
            'estado' => 'Activo',
            'fecha_registro' => '2024-01-15 08:30:00'
        ];

        return view('cuentas-por-cobrar.proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified proveedor.
     */
    public function proveedoresEdit($id)
    {
        // Simular datos del proveedor para edición
        $proveedor = [
            'id' => $id,
            'numero_documento' => '9876543210987',
            'tipo_documento' => 'NIT',
            'razon_social' => 'Distribuidora El Salvador S.A.',
            'nombre_comercial' => 'Distribuidora ES',
            'telefono' => '2234-5678',
            'email' => 'ventas@distribuidoraes.com',
            'direccion' => 'Av. Roosevelt #123, San Salvador',
            'departamento' => 'San Salvador',
            'municipio' => 'San Salvador Centro',
            'distrito' => 'San Salvador',
            'limite_credito' => 50000.00,
            'credito_disponible' => 35000.00,
            'estado' => 'Activo'
        ];

        return view('cuentas-por-cobrar.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified proveedor.
     */
    public function proveedoresUpdate(Request $request, $id)
    {
        $request->validate([
            'numero_documento' => 'required|string|max:20',
            'tipo_documento' => 'required|in:DUI,NIT,PASAPORTE,CARNET_EXTRANJERIA',
            'razon_social' => 'required|string|max:255',
            'nombre_comercial' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:500',
            'departamento' => 'nullable|string|max:100',
            'municipio' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100',
            'limite_credito' => 'nullable|numeric|min:0'
        ]);

        // Aquí se implementaría la lógica para actualizar en la base de datos
        // Por ahora simularemos el proceso

        return redirect()->route('cuentas-por-cobrar.proveedores.index')
                        ->with('success', 'Proveedor actualizado exitosamente');
    }

    /**
     * Remove the specified proveedor.
     */
    public function proveedoresDestroy($id)
    {
        // Aquí se implementaría la lógica para eliminar de la base de datos
        // Por ahora simularemos el proceso

        return redirect()->route('cuentas-por-cobrar.proveedores.index')
                        ->with('success', 'Proveedor eliminado exitosamente');
    }

    /**
     * Store a newly created proveedor via AJAX.
     */
    public function proveedoresStoreAjax(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|string|max:20',
            'tipo_documento' => 'required|in:DUI,NIT,PASAPORTE,CARNET_EXTRANJERIA',
            'razon_social' => 'required|string|max:255',
            'nombre_comercial' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:500',
            'departamento' => 'nullable|string|max:100',
            'municipio' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100'
        ]);

        // Simular la creación del proveedor (en producción se guardaría en la base de datos)
        $nuevoProveedor = [
            'id' => rand(1000, 9999), // ID temporal simulado
            'numero_documento' => $request->numero_documento,
            'tipo_documento' => $request->tipo_documento,
            'razon_social' => $request->razon_social,
            'nombre_comercial' => $request->nombre_comercial,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'departamento' => $request->departamento,
            'municipio' => $request->municipio,
            'distrito' => $request->distrito,
            'limite_credito' => 0,
            'credito_disponible' => 0,
            'estado' => 'Activo',
            'fecha_registro' => now()->format('Y-m-d H:i:s')
        ];

        return response()->json([
            'success' => true,
            'message' => 'Proveedor creado exitosamente',
            'proveedor' => $nuevoProveedor
        ]);
    }

    /**
     * Buscar proveedores (para AJAX)
     */
    public function proveedoresBuscar($term)
    {
        // Datos simulados de búsqueda
        $proveedores = [
            [
                'id' => 1,
                'numero_documento' => '9876543210987',
                'razon_social' => 'Distribuidora El Salvador S.A.',
                'telefono' => '2234-5678',
                'email' => 'ventas@distribuidoraes.com'
            ],
            [
                'id' => 2,
                'numero_documento' => '1234567890123',
                'razon_social' => 'Servicios Técnicos Profesionales S.A.',
                'telefono' => '2345-6789',
                'email' => 'info@serviciostech.com'
            ]
        ];

        // Filtrar proveedores que coincidan con el término de búsqueda
        $resultados = array_filter($proveedores, function($proveedor) use ($term) {
            return strpos(strtolower($proveedor['razon_social']), strtolower($term)) !== false ||
                   strpos($proveedor['numero_documento'], $term) !== false;
        });

        return response()->json(array_values($resultados));
    }
}