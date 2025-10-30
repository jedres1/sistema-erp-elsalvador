<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuentasPorPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Simulamos datos de cuentas por pagar
        $cuentasPorPagar = [
            [
                'id' => 1,
                'numero_factura' => 'PROV-2024-001',
                'proveedor' => 'Distribuidora El Salvador S.A.',
                'fecha_emision' => '2024-10-10',
                'fecha_vencimiento' => '2024-11-10',
                'monto_original' => 8500.00,
                'monto_pagado' => 0.00,
                'saldo_pendiente' => 8500.00,
                'estado' => 'Pendiente',
                'dias_vencido' => 0,
                'documento_tipo' => 'Factura de Compra',
                'categoria' => 'Inventario'
            ],
            [
                'id' => 2,
                'numero_factura' => 'SERV-2024-005',
                'proveedor' => 'Servicios Públicos S.A.',
                'fecha_emision' => '2024-09-25',
                'fecha_vencimiento' => '2024-10-25',
                'monto_original' => 1250.00,
                'monto_pagado' => 0.00,
                'saldo_pendiente' => 1250.00,
                'estado' => 'Vencida',
                'dias_vencido' => 4,
                'documento_tipo' => 'Factura de Servicios',
                'categoria' => 'Servicios'
            ],
            [
                'id' => 3,
                'numero_factura' => 'MANT-2024-012',
                'proveedor' => 'Mantenimiento Industrial Ltda.',
                'fecha_emision' => '2024-10-20',
                'fecha_vencimiento' => '2024-12-20',
                'monto_original' => 4800.00,
                'monto_pagado' => 2400.00,
                'saldo_pendiente' => 2400.00,
                'estado' => 'Parcial',
                'dias_vencido' => 0,
                'documento_tipo' => 'Factura de Servicios',
                'categoria' => 'Mantenimiento'
            ],
            [
                'id' => 4,
                'numero_factura' => 'PROV-2024-002',
                'proveedor' => 'Suministros de Oficina ABC',
                'fecha_emision' => '2024-08-20',
                'fecha_vencimiento' => '2024-09-20',
                'monto_original' => 650.00,
                'monto_pagado' => 650.00,
                'saldo_pendiente' => 0.00,
                'estado' => 'Pagada',
                'dias_vencido' => 0,
                'documento_tipo' => 'Factura de Compra',
                'categoria' => 'Oficina'
            ]
        ];

        // Estadísticas del módulo
        $estadisticas = [
            'total_por_pagar' => array_sum(array_column($cuentasPorPagar, 'saldo_pendiente')),
            'total_vencido' => array_sum(array_column(array_filter($cuentasPorPagar, function($cuenta) {
                return $cuenta['estado'] === 'Vencida';
            }), 'saldo_pendiente')),
            'total_al_dia' => array_sum(array_column(array_filter($cuentasPorPagar, function($cuenta) {
                return $cuenta['estado'] === 'Pendiente';
            }), 'saldo_pendiente')),
            'facturas_pendientes' => count(array_filter($cuentasPorPagar, function($cuenta) {
                return $cuenta['saldo_pendiente'] > 0;
            })),
            'facturas_vencidas' => count(array_filter($cuentasPorPagar, function($cuenta) {
                return $cuenta['estado'] === 'Vencida';
            })),
            'promedio_dias_pago' => 30
        ];

        return view('cuentas-por-pagar.index', compact('cuentasPorPagar', 'estadisticas'));
    }

    /**
     * Mostrar detalles de una cuenta por pagar específica
     */
    public function show($id)
    {
        // Simular datos de la cuenta específica
        $cuenta = [
            'id' => $id,
            'numero_factura' => 'PROV-2024-001',
            'proveedor' => 'Distribuidora El Salvador S.A.',
            'proveedor_documento' => '9876543210987',
            'fecha_emision' => '2024-10-10',
            'fecha_vencimiento' => '2024-11-10',
            'monto_original' => 8500.00,
            'monto_pagado' => 0.00,
            'saldo_pendiente' => 8500.00,
            'estado' => 'Pendiente',
            'dias_vencido' => 0,
            'documento_tipo' => 'Factura de Compra',
            'categoria' => 'Inventario',
            'observaciones' => 'Proveedor principal de inventario'
        ];

        // Historial de pagos
        $historialPagos = [];

        return view('cuentas-por-pagar.show', compact('cuenta', 'historialPagos'));
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

        return redirect()->route('cuentas-por-pagar.show', $id)
                        ->with('success', 'Pago registrado exitosamente');
    }

    /**
     * Generar reporte de antigüedad de saldos
     */
    public function reporteAntiguedad()
    {
        $reporteAntiguedad = [
            'corriente' => ['monto' => 8500.00, 'facturas' => 1],
            'de_1_a_30' => ['monto' => 2400.00, 'facturas' => 1],
            'de_31_a_60' => ['monto' => 0.00, 'facturas' => 0],
            'de_61_a_90' => ['monto' => 0.00, 'facturas' => 0],
            'mas_de_90' => ['monto' => 1250.00, 'facturas' => 1]
        ];

        return view('cuentas-por-pagar.reporte-antiguedad', compact('reporteAntiguedad'));
    }

    /**
     * Programar pago
     */
    public function programarPago(Request $request, $id)
    {
        $request->validate([
            'fecha_programada' => 'required|date|after_or_equal:today',
            'monto' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|string',
            'observaciones' => 'nullable|string|max:500'
        ]);

        // Simular programación de pago
        return redirect()->route('cuentas-por-pagar.show', $id)
                        ->with('success', 'Pago programado exitosamente');
    }

    /**
     * Exportar reporte a Excel
     */
    public function exportarExcel()
    {
        // Simular exportación
        return redirect()->route('cuentas-por-pagar.index')
                        ->with('success', 'Reporte exportado exitosamente');
    }

    /**
     * Aprobar pago pendiente
     */
    public function aprobarPago($id)
    {
        // Simular aprobación de pago
        return redirect()->route('cuentas-por-pagar.show', $id)
                        ->with('success', 'Pago aprobado exitosamente');
    }
}