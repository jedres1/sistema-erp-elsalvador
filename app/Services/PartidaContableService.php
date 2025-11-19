<?php

namespace App\Services;

use App\Models\DailyRegister;
use App\Models\DailyRegistersLine;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartidaContableService
{
    /**
     * Generar partida contable desde una factura
     * 
     * @param array $datosFactura - Debe contener: cliente_id, fecha, descripcion, items[]
     * @return DailyRegister
     */
    public function generarPartidaDesdeFactura(array $datosFactura)
    {
        DB::beginTransaction();
        try {
            // Obtener el cliente con su plantilla contable
            $cliente = Cliente::with('plantillaContable.cuentas.cuenta')->find($datosFactura['cliente_id']);
            
            if (!$cliente || !$cliente->plantillaContable) {
                throw new \Exception('El cliente no tiene una plantilla contable asignada');
            }

            // Crear la partida contable (sin mayorizar)
            $partida = DailyRegister::create([
                'date_register' => $datosFactura['fecha'] ?? now(),
                'description' => $datosFactura['descripcion'] ?? 'Factura de venta',
                'mount_debit' => 0, // Se calculará después
                'mount_credit' => 0, // Se calculará después
                'mayor' => 'N' // Sin mayorizar
            ]);

            $totalDebito = 0;
            $totalCredito = 0;
            $lineas = [];

            // 1. Crear el débito para la cuenta por cobrar del cliente
            $cuentaPorCobrar = $cliente->plantillaContable->getCuenta('cuentas_por_cobrar');
            
            if (!$cuentaPorCobrar) {
                throw new \Exception('La plantilla del cliente no tiene configurada la cuenta por cobrar');
            }

            $totalFactura = $this->calcularTotalFactura($datosFactura['items']);

            $lineas[] = [
                'daily_register_id' => $partida->id,
                'account_catalog_id' => $cuentaPorCobrar->account_catalog_id,
                'mount' => $totalFactura,
                'type_transaction' => 'D', // Débito
                'created_at' => now(),
                'updated_at' => now()
            ];
            $totalDebito += $totalFactura;

            // 2. Procesar cada producto/servicio de la factura
            foreach ($datosFactura['items'] as $item) {
                $producto = Producto::with('plantillaContable.cuentas.cuenta')->find($item['producto_id']);
                
                if (!$producto || !$producto->plantillaContable) {
                    throw new \Exception("El producto {$item['producto_id']} no tiene plantilla contable asignada");
                }

                $subtotal = $item['cantidad'] * $item['precio_unitario'];

                // 2.1 Crédito a Ingresos por Venta
                $cuentaIngreso = $producto->plantillaContable->getCuenta('ingresos_venta');
                if (!$cuentaIngreso) {
                    throw new \Exception("El producto {$producto->nombre} no tiene cuenta de ingreso configurada");
                }

                $lineas[] = [
                    'daily_register_id' => $partida->id,
                    'account_catalog_id' => $cuentaIngreso->account_catalog_id,
                    'mount' => $subtotal,
                    'type_transaction' => 'A', // Crédito
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                $totalCredito += $subtotal;

                // 2.2 Si el producto maneja inventario, crear asientos de costo
                if ($producto->maneja_inventario) {
                    $cuentaInventario = $producto->plantillaContable->getCuenta('inventario');
                    $cuentaCostoVenta = $producto->plantillaContable->getCuenta('costo_venta');

                    if ($cuentaInventario && $cuentaCostoVenta) {
                        $costoTotal = $item['cantidad'] * $producto->precio_compra;

                        // Débito a Costo de Venta
                        $lineas[] = [
                            'daily_register_id' => $partida->id,
                            'account_catalog_id' => $cuentaCostoVenta->account_catalog_id,
                            'mount' => $costoTotal,
                            'type_transaction' => 'D',
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        $totalDebito += $costoTotal;

                        // Crédito a Inventario
                        $lineas[] = [
                            'daily_register_id' => $partida->id,
                            'account_catalog_id' => $cuentaInventario->account_catalog_id,
                            'mount' => $costoTotal,
                            'type_transaction' => 'A',
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        $totalCredito += $costoTotal;
                    }
                }
            }

            // Insertar todas las líneas
            DailyRegistersLine::insert($lineas);

            // Actualizar totales de la partida
            $partida->update([
                'mount_debit' => $totalDebito,
                'mount_credit' => $totalCredito
            ]);

            // Validar que la partida esté balanceada
            if (round($totalDebito, 2) != round($totalCredito, 2)) {
                throw new \Exception("La partida no está balanceada. Débito: {$totalDebito}, Crédito: {$totalCredito}");
            }

            DB::commit();
            return $partida;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Calcular el total de la factura
     */
    private function calcularTotalFactura(array $items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['cantidad'] * $item['precio_unitario'];
        }
        return $total;
    }

    /**
     * Mayorizar una partida contable
     */
    public function mayorizarPartida($partidaId)
    {
        DB::beginTransaction();
        try {
            $partida = DailyRegister::with('lines')->findOrFail($partidaId);
            
            if ($partida->mayor === 'S') {
                throw new \Exception('Esta partida ya está mayorizada');
            }

            // Aquí se puede agregar lógica adicional para el mayor general
            // Por ahora solo cambiamos el estado
            $partida->update(['mayor' => 'S']);

            DB::commit();
            return $partida;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
