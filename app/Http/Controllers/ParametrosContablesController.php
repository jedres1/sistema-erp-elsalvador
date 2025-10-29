<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametrosContablesController extends Controller
{
    /**
     * Mostrar la lista de plantillas de transacciones
     */
    public function index()
    {
        $plantillas = $this->getPlantillasEjemplo();
        return view('parametros.index', compact('plantillas'));
    }

    /**
     * Mostrar el formulario para crear una nueva plantilla
     */
    public function create()
    {
        return view('parametros.create');
    }

    /**
     * Almacenar una nueva plantilla
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|in:venta,compra,nomina,gasto,otro',
            'descripcion' => 'required|string',
            'cuentas' => 'required|array|min:1',
            'cuentas.*.tipo' => 'required|string|in:debito,credito',
            'cuentas.*.concepto' => 'required|string|max:255',
            'cuentas.*.formula' => 'required|string|max:255',
        ]);

        // Aquí se guardaría la plantilla en la base de datos
        return redirect()->route('parametros.index')
                         ->with('success', 'Plantilla creada exitosamente');
    }

    /**
     * Mostrar una plantilla específica
     */
    public function show($id)
    {
        $plantilla = collect($this->getPlantillasEjemplo())->firstWhere('id', (int)$id);
        
        if (!$plantilla) {
            abort(404);
        }
        
        return view('parametros.show', compact('plantilla'));
    }

    /**
     * Mostrar el formulario para editar una plantilla
     */
    public function edit($id)
    {
        $plantilla = collect($this->getPlantillasEjemplo())->firstWhere('id', (int)$id);
        
        if (!$plantilla) {
            abort(404);
        }
        
        return view('parametros.edit', compact('plantilla'));
    }

    /**
     * Actualizar una plantilla
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|in:venta,compra,nomina,gasto,otro',
            'descripcion' => 'required|string',
            'cuentas' => 'required|array|min:1',
            'cuentas.*.tipo' => 'required|string|in:debito,credito',
            'cuentas.*.concepto' => 'required|string|max:255',
            'cuentas.*.formula' => 'required|string|max:255',
        ]);

        // Aquí se actualizaría la plantilla en la base de datos
        return redirect()->route('parametros.index')
                         ->with('success', 'Plantilla actualizada exitosamente');
    }

    /**
     * Eliminar una plantilla
     */
    public function destroy($id)
    {
        // Aquí se eliminaría la plantilla de la base de datos
        return redirect()->route('parametros.index')
                         ->with('success', 'Plantilla eliminada exitosamente');
    }

    /**
     * Alternar el estado activo/inactivo de una plantilla
     */
    public function toggle($id)
    {
        // Aquí se cambiaría el estado activo/inactivo de la plantilla
        return redirect()->route('parametros.index')
                         ->with('success', 'Estado de la plantilla actualizado');
    }

    /**
     * Obtener plantillas de ejemplo para demostración
     */
    private function getPlantillasEjemplo()
    {
        return [
            [
                'id' => 1,
                'nombre' => 'Venta al Contado',
                'tipo' => 'venta',
                'descripcion' => 'Plantilla para registrar ventas de contado con IVA incluido',
                'activa' => true,
                'cuentas' => [
                    [
                        'tipo' => 'debito',
                        'concepto' => 'Caja',
                        'formula' => 'total'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'Ventas',
                        'formula' => 'subtotal'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'IVA por Pagar',
                        'formula' => 'iva'
                    ]
                ]
            ],
            [
                'id' => 2,
                'nombre' => 'Venta a Crédito',
                'tipo' => 'venta',
                'descripcion' => 'Plantilla para registrar ventas a crédito con cuentas por cobrar',
                'activa' => true,
                'cuentas' => [
                    [
                        'tipo' => 'debito',
                        'concepto' => 'Cuentas por Cobrar',
                        'formula' => 'total'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'Ventas',
                        'formula' => 'subtotal'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'IVA por Pagar',
                        'formula' => 'iva'
                    ]
                ]
            ],
            [
                'id' => 3,
                'nombre' => 'Compra al Contado',
                'tipo' => 'compra',
                'descripcion' => 'Plantilla para registrar compras pagadas de contado',
                'activa' => true,
                'cuentas' => [
                    [
                        'tipo' => 'debito',
                        'concepto' => 'Inventario',
                        'formula' => 'subtotal'
                    ],
                    [
                        'tipo' => 'debito',
                        'concepto' => 'IVA Acreditable',
                        'formula' => 'iva'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'Bancos',
                        'formula' => 'total'
                    ]
                ]
            ],
            [
                'id' => 4,
                'nombre' => 'Compra a Crédito',
                'tipo' => 'compra',
                'descripcion' => 'Plantilla para registrar compras a crédito con proveedores',
                'activa' => true,
                'cuentas' => [
                    [
                        'tipo' => 'debito',
                        'concepto' => 'Inventario',
                        'formula' => 'subtotal'
                    ],
                    [
                        'tipo' => 'debito',
                        'concepto' => 'IVA Acreditable',
                        'formula' => 'iva'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'Proveedores',
                        'formula' => 'total'
                    ]
                ]
            ],
            [
                'id' => 5,
                'nombre' => 'Pago de Nómina',
                'tipo' => 'nomina',
                'descripcion' => 'Plantilla para el registro de pagos de nómina quincenal',
                'activa' => false,
                'cuentas' => [
                    [
                        'tipo' => 'debito',
                        'concepto' => 'Sueldos y Salarios',
                        'formula' => 'subtotal'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'Retenciones ISR',
                        'formula' => 'descuento'
                    ],
                    [
                        'tipo' => 'credito',
                        'concepto' => 'Bancos',
                        'formula' => 'total'
                    ]
                ]
            ]
        ];
    }
}