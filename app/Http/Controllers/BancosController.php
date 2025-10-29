<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BancosController extends Controller
{
    /**
     * Mostrar el dashboard de control bancario
     */
    public function index()
    {
        $cuentas_bancarias = $this->getCuentasBancarias();
        $movimientos_recientes = $this->getMovimientosRecientes();
        $estadisticas = $this->getEstadisticasBancarias();
        
        return view('bancos.index', compact('cuentas_bancarias', 'movimientos_recientes', 'estadisticas'));
    }

    /**
     * Mostrar el formulario para crear una nueva cuenta bancaria
     */
    public function create()
    {
        $bancos = $this->getBancos();
        
        return view('bancos.create', compact('bancos'));
    }

    /**
     * Almacenar una nueva cuenta bancaria
     */
    public function store(Request $request)
    {
        $request->validate([
            'banco_id' => 'required|integer',
            'numero_cuenta' => 'required|string|unique:cuentas_bancarias,numero_cuenta',
            'tipo_cuenta' => 'required|string|in:cheques,ahorros,inversion',
            'saldo_inicial' => 'required|numeric',
            'fecha_apertura' => 'required|date',
        ]);

        // Aquí se guardaría la cuenta bancaria en la base de datos
        return redirect()->route('bancos.index')
                         ->with('success', 'Cuenta bancaria creada exitosamente');
    }

    /**
     * Mostrar una cuenta bancaria específica
     */
    public function show($id)
    {
        $cuenta = $this->getCuentaBancaria($id);
        $movimientos = $this->getMovimientosCuenta($id);
        $estadisticas_cuenta = $this->getEstadisticasCuenta($id);
        
        if (!$cuenta) {
            abort(404);
        }
        
        return view('bancos.show', compact('cuenta', 'movimientos', 'estadisticas_cuenta'));
    }

    /**
     * Mostrar el formulario para editar una cuenta bancaria
     */
    public function edit($id)
    {
        $cuenta = $this->getCuentaBancaria($id);
        $bancos = $this->getBancos();
        
        if (!$cuenta) {
            abort(404);
        }
        
        return view('bancos.edit', compact('cuenta', 'bancos'));
    }

    /**
     * Actualizar una cuenta bancaria
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'banco_id' => 'required|integer',
            'numero_cuenta' => 'required|string',
            'tipo_cuenta' => 'required|string|in:cheques,ahorros,inversion',
            'saldo_inicial' => 'required|numeric',
            'fecha_apertura' => 'required|date',
        ]);

        // Aquí se actualizaría la cuenta bancaria en la base de datos
        return redirect()->route('bancos.index')
                         ->with('success', 'Cuenta bancaria actualizada exitosamente');
    }

    /**
     * Eliminar una cuenta bancaria
     */
    public function destroy($id)
    {
        // Aquí se eliminaría la cuenta bancaria de la base de datos
        return redirect()->route('bancos.index')
                         ->with('success', 'Cuenta bancaria eliminada exitosamente');
    }

    /**
     * Registrar un depósito
     */
    public function deposito(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|integer',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'concepto' => 'required|string|max:255',
            'referencia' => 'nullable|string|max:100',
        ]);

        // Aquí se registraría el depósito
        return redirect()->route('bancos.index')
                         ->with('success', 'Depósito registrado exitosamente');
    }

    /**
     * Registrar un retiro
     */
    public function retiro(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|integer',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'concepto' => 'required|string|max:255',
            'referencia' => 'nullable|string|max:100',
        ]);

        // Aquí se registraría el retiro
        return redirect()->route('bancos.index')
                         ->with('success', 'Retiro registrado exitosamente');
    }

    /**
     * Registrar una transferencia
     */
    public function transferencia(Request $request)
    {
        $request->validate([
            'cuenta_origen_id' => 'required|integer',
            'cuenta_destino_id' => 'required|integer|different:cuenta_origen_id',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'concepto' => 'required|string|max:255',
        ]);

        // Aquí se registraría la transferencia
        return redirect()->route('bancos.index')
                         ->with('success', 'Transferencia registrada exitosamente');
    }

    /**
     * Conciliar cuenta bancaria
     */
    public function conciliar($id)
    {
        $cuenta = $this->getCuentaBancaria($id);
        $movimientos_pendientes = $this->getMovimientosPendientesConciliacion($id);
        
        if (!$cuenta) {
            abort(404);
        }
        
        return view('bancos.conciliar', compact('cuenta', 'movimientos_pendientes'));
    }

    /**
     * Obtener cuentas bancarias
     */
    private function getCuentasBancarias()
    {
        return [
            [
                'id' => 1,
                'banco' => 'BBVA',
                'numero_cuenta' => '****1234',
                'tipo_cuenta' => 'cheques',
                'saldo_actual' => 125000.00,
                'estado' => 'activa',
                'fecha_ultimo_movimiento' => '2025-10-25'
            ],
            [
                'id' => 2,
                'banco' => 'Santander',
                'numero_cuenta' => '****5678',
                'tipo_cuenta' => 'ahorros',
                'saldo_actual' => 85000.00,
                'estado' => 'activa',
                'fecha_ultimo_movimiento' => '2025-10-24'
            ],
            [
                'id' => 3,
                'banco' => 'Banamex',
                'numero_cuenta' => '****9012',
                'tipo_cuenta' => 'inversion',
                'saldo_actual' => 250000.00,
                'estado' => 'activa',
                'fecha_ultimo_movimiento' => '2025-10-23'
            ]
        ];
    }

    /**
     * Obtener movimientos recientes
     */
    private function getMovimientosRecientes()
    {
        return [
            [
                'fecha' => '2025-10-25',
                'cuenta' => 'BBVA ****1234',
                'tipo' => 'deposito',
                'concepto' => 'Pago de cliente ABC',
                'monto' => 15000.00,
                'saldo' => 125000.00
            ],
            [
                'fecha' => '2025-10-24',
                'cuenta' => 'Santander ****5678',
                'tipo' => 'retiro',
                'concepto' => 'Pago a proveedor',
                'monto' => -8500.00,
                'saldo' => 85000.00
            ],
            [
                'fecha' => '2025-10-23',
                'cuenta' => 'BBVA ****1234',
                'tipo' => 'transferencia',
                'concepto' => 'Transferencia interna',
                'monto' => -25000.00,
                'saldo' => 110000.00
            ]
        ];
    }

    /**
     * Obtener estadísticas bancarias
     */
    private function getEstadisticasBancarias()
    {
        return [
            'total_efectivo' => 460000.00,
            'cuentas_activas' => 3,
            'ingresos_mes' => 125000.00,
            'egresos_mes' => 85000.00
        ];
    }

    /**
     * Obtener lista de bancos
     */
    private function getBancos()
    {
        return [
            ['id' => 1, 'nombre' => 'BBVA'],
            ['id' => 2, 'nombre' => 'Santander'],
            ['id' => 3, 'nombre' => 'Banamex'],
            ['id' => 4, 'nombre' => 'Banorte'],
            ['id' => 5, 'nombre' => 'HSBC']
        ];
    }

    /**
     * Obtener una cuenta bancaria específica
     */
    private function getCuentaBancaria($id)
    {
        $cuentas = $this->getCuentasBancarias();
        return collect($cuentas)->firstWhere('id', (int)$id);
    }

    /**
     * Obtener movimientos de una cuenta específica
     */
    private function getMovimientosCuenta($id)
    {
        return [
            [
                'fecha' => '2025-10-25',
                'tipo' => 'deposito',
                'concepto' => 'Pago de cliente ABC',
                'referencia' => 'REF123',
                'monto' => 15000.00,
                'saldo' => 125000.00
            ],
            [
                'fecha' => '2025-10-24',
                'tipo' => 'retiro',
                'concepto' => 'Pago nómina',
                'referencia' => 'CHQ456',
                'monto' => -35000.00,
                'saldo' => 110000.00
            ]
        ];
    }

    /**
     * Obtener estadísticas de una cuenta específica
     */
    private function getEstadisticasCuenta($id)
    {
        return [
            'saldo_inicial_mes' => 145000.00,
            'total_ingresos_mes' => 45000.00,
            'total_egresos_mes' => 65000.00,
            'saldo_actual' => 125000.00,
            'movimientos_mes' => 12
        ];
    }

    /**
     * Obtener movimientos pendientes de conciliación
     */
    private function getMovimientosPendientesConciliacion($id)
    {
        return [
            [
                'fecha' => '2025-10-25',
                'concepto' => 'Pago cliente XYZ',
                'monto' => 8500.00,
                'estado' => 'pendiente'
            ],
            [
                'fecha' => '2025-10-24',
                'concepto' => 'Comisión bancaria',
                'monto' => -150.00,
                'estado' => 'pendiente'
            ]
        ];
    }
}