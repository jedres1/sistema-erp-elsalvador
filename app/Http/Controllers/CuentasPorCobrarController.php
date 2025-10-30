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
}