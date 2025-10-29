<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountCatalogSeeder extends Seeder
{
    public function run()
    {
       DB::table('account_catalogs')->insert([
            // ========== 1. ACTIVOS ==========
            [
                'code' => '1.0.00.00.00.00.00',
                'description' => 'ACTIVO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // ===== 1.1 ACTIVOS CORRIENTES =====
            [
                'code' => '1.1.00.00.00.00.00',
                'description' => 'ACTIVOS CORRIENTES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // === 1.1.01 EFECTIVO Y EQUIVALENTES ===
            [
                'code' => '1.1.01.00.00.00.00',
                'description' => 'EFECTIVO Y EQUIVALENTES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '1.1.01.01.00.00.00',
                'description' => 'CAJA GENERAL', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.01.02.00.00.00',
                'description' => 'CAJA CHICA', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.01.03.00.00.00',
                'description' => 'BANCOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.01.04.00.00.00',
                'description' => 'INVERSIONES TEMPORALES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            
            // === 1.1.02 CUENTAS POR COBRAR ===
            [
                'code' => '1.1.02.00.00.00.00',
                'description' => 'CUENTAS POR COBRAR', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '1.1.02.01.00.00.00',
                'description' => 'CLIENTES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.02.02.00.00.00',
                'description' => 'DOCUMENTOS POR COBRAR', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.02.03.00.00.00',
                'description' => 'CUENTAS POR COBRAR EMPLEADOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.02.04.00.00.00',
                'description' => 'IVA CRÉDITO FISCAL', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.02.05.00.00.00',
                'description' => 'ANTICIPOS A PROVEEDORES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.02.06.00.00.00',
                'description' => 'PROVISIÓN CUENTAS INCOBRABLES', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            
            // === 1.1.03 INVENTARIOS ===
            [
                'code' => '1.1.03.00.00.00.00',
                'description' => 'INVENTARIOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '1.1.03.01.00.00.00',
                'description' => 'MERCADERÍA PARA LA VENTA', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.03.02.00.00.00',
                'description' => 'MATERIALES Y SUMINISTROS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.03.03.00.00.00',
                'description' => 'PRODUCTOS EN PROCESO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.03.04.00.00.00',
                'description' => 'PRODUCTOS TERMINADOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            
            // === 1.1.04 GASTOS PAGADOS POR ADELANTADO ===
            [
                'code' => '1.1.04.00.00.00.00',
                'description' => 'GASTOS PAGADOS POR ADELANTADO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '1.1.04.01.00.00.00',
                'description' => 'SEGUROS PAGADOS POR ADELANTADO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.04.02.00.00.00',
                'description' => 'ALQUILERES PAGADOS POR ADELANTADO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.1.04.03.00.00.00',
                'description' => 'PAPELERÍA Y ÚTILES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            
            // ===== 1.2 ACTIVOS NO CORRIENTES =====
            [
                'code' => '1.2.00.00.00.00.00',
                'description' => 'ACTIVOS NO CORRIENTES', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // === 1.2.01 PROPIEDAD, PLANTA Y EQUIPO ===
            [
                'code' => '1.2.01.00.00.00.00',
                'description' => 'PROPIEDAD, PLANTA Y EQUIPO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '1.2.01.01.00.00.00',
                'description' => 'TERRENOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.01.02.00.00.00',
                'description' => 'EDIFICIOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.01.03.00.00.00',
                'description' => 'MOBILIARIO Y EQUIPO DE OFICINA', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.01.04.00.00.00',
                'description' => 'EQUIPO DE TRANSPORTE', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.01.05.00.00.00',
                'description' => 'EQUIPO DE CÓMPUTO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.01.06.00.00.00',
                'description' => 'MAQUINARIA Y EQUIPO', 
                'type_account' => 'A', 
                'type_naturaled' => 'D', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            
            // === 1.2.02 DEPRECIACIÓN ACUMULADA ===
            [
                'code' => '1.2.02.00.00.00.00',
                'description' => 'DEPRECIACIÓN ACUMULADA', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '1.2.02.01.00.00.00',
                'description' => 'DEPRECIACIÓN ACUMULADA EDIFICIOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.02.02.00.00.00',
                'description' => 'DEPRECIACIÓN ACUMULADA MOBILIARIO', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.02.03.00.00.00',
                'description' => 'DEPRECIACIÓN ACUMULADA VEHÍCULOS', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.02.04.00.00.00',
                'description' => 'DEPRECIACIÓN ACUMULADA EQUIPO CÓMPUTO', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '1.2.02.05.00.00.00',
                'description' => 'DEPRECIACIÓN ACUMULADA MAQUINARIA', 
                'type_account' => 'A', 
                'type_naturaled' => 'A', 
                'group' => 'D',
                'accept_transaction' => 'S'
            ],
            
            // ========== 2. PASIVOS ==========
            [
                'code' => '2.0.00.00.00.00.00',
                'description' => 'PASIVO', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // ===== 2.1 PASIVOS CORRIENTES =====
            [
                'code' => '2.1.00.00.00.00.00',
                'description' => 'PASIVOS CORRIENTES', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // === 2.1.01 CUENTAS POR PAGAR ===
            [
                'code' => '2.1.01.00.00.00.00',
                'description' => 'CUENTAS POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '2.1.01.01.00.00.00',
                'description' => 'PROVEEDORES', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.01.02.00.00.00',
                'description' => 'DOCUMENTOS POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.01.03.00.00.00',
                'description' => 'ACREEDORES DIVERSOS', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.01.04.00.00.00',
                'description' => 'IVA DÉBITO FISCAL', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.01.05.00.00.00',
                'description' => 'RETENCIONES POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            
            // === 2.1.02 OBLIGACIONES LABORALES ===
            [
                'code' => '2.1.02.00.00.00.00',
                'description' => 'OBLIGACIONES LABORALES', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '2.1.02.01.00.00.00',
                'description' => 'SALARIOS POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.02.02.00.00.00',
                'description' => 'VACACIONES POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.02.03.00.00.00',
                'description' => 'AGUINALDO POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.02.04.00.00.00',
                'description' => 'INDEMNIZACIONES POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.02.05.00.00.00',
                'description' => 'CUOTAS PATRONALES ISSS', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.02.06.00.00.00',
                'description' => 'CUOTAS PATRONALES AFP', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            
            // === 2.1.03 PRÉSTAMOS A CORTO PLAZO ===
            [
                'code' => '2.1.03.00.00.00.00',
                'description' => 'PRÉSTAMOS A CORTO PLAZO', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '2.1.03.01.00.00.00',
                'description' => 'PRÉSTAMOS BANCARIOS', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.1.03.02.00.00.00',
                'description' => 'LÍNEAS DE CRÉDITO', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            
            // ===== 2.2 PASIVOS NO CORRIENTES =====
            [
                'code' => '2.2.00.00.00.00.00',
                'description' => 'PASIVOS NO CORRIENTES', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '2.2.01.00.00.00.00',
                'description' => 'PRÉSTAMOS A LARGO PLAZO', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '2.2.02.00.00.00.00',
                'description' => 'HIPOTECAS POR PAGAR', 
                'type_account' => 'P', 
                'type_naturaled' => 'A', 
                'group' => 'A',
                'accept_transaction' => 'S'
            ],
            
            // ========== 3. PATRIMONIO ==========
            [
                'code' => '3.0.00.00.00.00.00',
                'description' => 'PATRIMONIO', 
                'type_account' => 'PT', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '3.1.00.00.00.00.00',
                'description' => 'CAPITAL SOCIAL', 
                'type_account' => 'PT', 
                'type_naturaled' => 'A', 
                'group' => 'PT',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '3.2.00.00.00.00.00',
                'description' => 'RESERVAS', 
                'type_account' => 'PT', 
                'type_naturaled' => 'A', 
                'group' => 'PT',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '3.3.00.00.00.00.00',
                'description' => 'UTILIDADES RETENIDAS', 
                'type_account' => 'PT', 
                'type_naturaled' => 'A', 
                'group' => 'PT',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '3.4.00.00.00.00.00',
                'description' => 'UTILIDAD DEL EJERCICIO', 
                'type_account' => 'PT', 
                'type_naturaled' => 'A', 
                'group' => 'PT',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '3.5.00.00.00.00.00',
                'description' => 'PÉRDIDA DEL EJERCICIO', 
                'type_account' => 'PT', 
                'type_naturaled' => 'D', 
                'group' => 'PT',
                'accept_transaction' => 'S'
            ],
            
            // ========== 4. INGRESOS ==========
            [
                'code' => '4.0.00.00.00.00.00',
                'description' => 'INGRESOS', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // ===== 4.1 INGRESOS OPERACIONALES =====
            [
                'code' => '4.1.00.00.00.00.00',
                'description' => 'INGRESOS OPERACIONALES', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '4.1.01.00.00.00.00',
                'description' => 'VENTAS', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'R',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '4.1.02.00.00.00.00',
                'description' => 'INGRESOS POR SERVICIOS', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'R',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '4.1.03.00.00.00.00',
                'description' => 'DESCUENTOS Y REBAJAS EN VENTAS', 
                'type_account' => 'R', 
                'type_naturaled' => 'D', 
                'group' => 'R',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '4.1.04.00.00.00.00',
                'description' => 'DEVOLUCIONES EN VENTAS', 
                'type_account' => 'R', 
                'type_naturaled' => 'D', 
                'group' => 'R',
                'accept_transaction' => 'S'
            ],
            
            // ===== 4.2 INGRESOS NO OPERACIONALES =====
            [
                'code' => '4.2.00.00.00.00.00',
                'description' => 'INGRESOS NO OPERACIONALES', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '4.2.01.00.00.00.00',
                'description' => 'INGRESOS FINANCIEROS', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'R',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '4.2.02.00.00.00.00',
                'description' => 'OTROS INGRESOS', 
                'type_account' => 'R', 
                'type_naturaled' => 'A', 
                'group' => 'R',
                'accept_transaction' => 'S'
            ],
            
            // ========== 5. COSTOS ==========
            [
                'code' => '5.0.00.00.00.00.00',
                'description' => 'COSTOS DE VENTAS', 
                'type_account' => 'C', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '5.1.00.00.00.00.00',
                'description' => 'COSTO DE MERCADERÍA VENDIDA', 
                'type_account' => 'C', 
                'type_naturaled' => 'D', 
                'group' => 'C',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '5.2.00.00.00.00.00',
                'description' => 'COSTO DE SERVICIOS PRESTADOS', 
                'type_account' => 'C', 
                'type_naturaled' => 'D', 
                'group' => 'C',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '5.3.00.00.00.00.00',
                'description' => 'COMPRAS', 
                'type_account' => 'C', 
                'type_naturaled' => 'D', 
                'group' => 'C',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '5.4.00.00.00.00.00',
                'description' => 'FLETES EN COMPRAS', 
                'type_account' => 'C', 
                'type_naturaled' => 'D', 
                'group' => 'C',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '5.5.00.00.00.00.00',
                'description' => 'DESCUENTOS Y REBAJAS EN COMPRAS', 
                'type_account' => 'C', 
                'type_naturaled' => 'A', 
                'group' => 'C',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '5.6.00.00.00.00.00',
                'description' => 'DEVOLUCIONES EN COMPRAS', 
                'type_account' => 'C', 
                'type_naturaled' => 'A', 
                'group' => 'C',
                'accept_transaction' => 'S'
            ],
            
            // ========== 6. GASTOS ==========
            [
                'code' => '6.0.00.00.00.00.00',
                'description' => 'GASTOS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            
            // ===== 6.1 GASTOS DE ADMINISTRACIÓN =====
            [
                'code' => '6.1.00.00.00.00.00',
                'description' => 'GASTOS DE ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '6.1.01.00.00.00.00',
                'description' => 'SUELDOS Y SALARIOS ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.02.00.00.00.00',
                'description' => 'PRESTACIONES SOCIALES ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.03.00.00.00.00',
                'description' => 'ALQUILERES ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.04.00.00.00.00',
                'description' => 'SERVICIOS PÚBLICOS ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.05.00.00.00.00',
                'description' => 'DEPRECIACIÓN ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.06.00.00.00.00',
                'description' => 'SEGUROS ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.07.00.00.00.00',
                'description' => 'PAPELERÍA Y ÚTILES ADMINISTRACIÓN', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.08.00.00.00.00',
                'description' => 'MANTENIMIENTO Y REPARACIONES', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.09.00.00.00.00',
                'description' => 'GASTOS LEGALES Y PROFESIONALES', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.1.10.00.00.00.00',
                'description' => 'GASTOS DE VIAJE', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            
            // ===== 6.2 GASTOS DE VENTAS =====
            [
                'code' => '6.2.00.00.00.00.00',
                'description' => 'GASTOS DE VENTAS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '6.2.01.00.00.00.00',
                'description' => 'SUELDOS Y SALARIOS VENTAS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.2.02.00.00.00.00',
                'description' => 'COMISIONES SOBRE VENTAS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.2.03.00.00.00.00',
                'description' => 'PUBLICIDAD Y PROPAGANDA', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.2.04.00.00.00.00',
                'description' => 'FLETES EN VENTAS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.2.05.00.00.00.00',
                'description' => 'EMPAQUES Y EMBALAJES', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.2.06.00.00.00.00',
                'description' => 'CUENTAS INCOBRABLES', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            
            // ===== 6.3 GASTOS FINANCIEROS =====
            [
                'code' => '6.3.00.00.00.00.00',
                'description' => 'GASTOS FINANCIEROS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '6.3.01.00.00.00.00',
                'description' => 'INTERESES SOBRE PRÉSTAMOS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.3.02.00.00.00.00',
                'description' => 'COMISIONES BANCARIAS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.3.03.00.00.00.00',
                'description' => 'GASTOS BANCARIOS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            
            // ===== 6.4 OTROS GASTOS =====
            [
                'code' => '6.4.00.00.00.00.00',
                'description' => 'OTROS GASTOS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'B',
                'accept_transaction' => 'N'
            ],
            [
                'code' => '6.4.01.00.00.00.00',
                'description' => 'GASTOS EXTRAORDINARIOS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.4.02.00.00.00.00',
                'description' => 'PÉRDIDAS EN VENTA DE ACTIVOS', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ],
            [
                'code' => '6.4.03.00.00.00.00',
                'description' => 'MULTAS Y SANCIONES', 
                'type_account' => 'G', 
                'type_naturaled' => 'D', 
                'group' => 'G',
                'accept_transaction' => 'S'
            ]
        ]);
    }
}