<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountCatalogSeeder extends Seeder
{
    public function run()
    {
       DB::table('account_catalogs')->insert([
            [
                'code' =>'1.0.00.00.00.00.00',
                'description' => 'ACTIVO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.00.00.00.00.00',
                'description' => 'ACTIVOS CORRIENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.00.00.00.00',
                'description' => 'EFECTIVO Y EQUIVALENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.01.00.00.00',
                'description' => 'CAJA GENERAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.01.01.00.00',
                'description' => 'OFICINA ADMINISTRATIVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.01.01.01.00',
                'description' => 'MONEDA LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.01.01.02.00',
                'description' => 'MONEDA EXTRANJERA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.01.01.03.00',
                'description' => 'Fondos por Recibir Factoraje', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.01.02.00.00',
                'description' => 'SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.01.02.01.00',
                'description' => 'MONEDA LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.01.02.02.00',
                'description' => 'MONEDA EXTRANJERA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.02.00.00.00',
                'description' => 'CAJA CHICA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.02.01.00.00',
                'description' => 'OFICINA ADMINISTRATIVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.02.01.01.00',
                'description' => 'MONEDA LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.02.02.00.00',
                'description' => 'SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.02.02.01.00',
                'description' => 'MONEDA LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.00.00.00',
                'description' => 'BANCOS Y FINANCIERAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.03.01.00.00',
                'description' => 'CUENTAS CORRIENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.03.01.01.00',
                'description' => 'Banco Cuscatlán de El Salvador, S.A', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.02.00',
                'description' => 'Banco Davivienda Salvadoreño, S.A', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.03.00',
                'description' => 'BANCO AGRICOLA, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.04.00',
                'description' => 'BANCO DE AMERICA CENTRAL, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.05.00',
                'description' => 'BANCO LAFISE, PANAMA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.06.00',
                'description' => 'Banco Cuscatlán de El Salvador, S.A (CTA ESPECIAL)', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.07.00',
                'description' => 'BANCO ATLANTIDA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.08.00',
                'description' => 'BANCO HIPOTECARIO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.09.00',
                'description' => 'BACNCO PROMERICA, S.A', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.01.10.00',
                'description' => 'BANCO INDUSTRIAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.02.00.00',
                'description' => 'CUENTAS DE AHORRO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B',
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.03.02.01.00',
                'description' => 'BANCO CITIBANK, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B',
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.02.02.00',
                'description' => 'BANCO DAVIVIENDA, S.A', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.02.03.00',
                'description' => 'BANCO AGRICOLA, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.02.04.00',
                'description' => 'BANCO DE AMERICA CENTRAL, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.03.00.00',
                'description' => 'DEPOSITOS A PLAZO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.03.03.01.00',
                'description' => 'BANCO CITIBANK, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.03.02.00',
                'description' => 'BANCO HSBC SALVADOREÑO, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.03.03.00',
                'description' => 'BANCO AGRICOLA, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.03.03.04.00',
                'description' => 'BANCO DE AMERICA CENTRAL, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.04.00.00.00',
                'description' => 'FONDOS DE CAMBIO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.04.01.00.00',
                'description' => 'OFICINA ADMINISTRATIVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.04.01.01.00',
                'description' => 'MONEDA LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.04.02.00.00',
                'description' => 'SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.04.02.01.00',
                'description' => 'MONEDA LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.05.00.00.00',
                'description' => 'EQUIVALENTES DE EFECTIVO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.01.05.01.00.00',
                'description' => 'PAGARES DE TARJETAS DE CREDITO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.01.05.02.00.00',
                'description' => 'REPORTOS DE BOLSA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.00.00.00.00',
                'description' => 'CUENTAS POR COBRAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.01.00.00.00',
                'description' => 'CLIENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.01.01.00.00',
                'description' => 'CLIENTES NACIONALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.01.01.01.00',
                'description' => 'CLIENTES SECTOR FINANCIERO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.01.02.00',
                'description' => 'CLIENTES SECTOR COMERCIO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.01.03.00',
                'description' => 'CLIENTES SECTOR INDUSTRIAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.01.04.00',
                'description' => 'CLIENTES SECTOR GUBERNAMENTAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.01.05.00',
                'description' => 'CLIENTES AGENCIAS PUBLICITARIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.01.06.00',
                'description' => 'EMPRESAS RELACIONADAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.01.07.00',
                'description' => 'FUNCIONARIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.02.00.00',
                'description' => 'CLIENTES DEL EXTERIOR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.01.02.01.00',
                'description' => 'GUATEMALA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.02.02.00',
                'description' => 'HONDURAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.02.03.00',
                'description' => 'NICARAGUA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.02.04.00',
                'description' => 'PANAMA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.03.00.00',
                'description' => 'ESTIMACION PARA CUENTAS INCOBRABLES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.01.03.01.00',
                'description' => 'LOCALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.01.03.02.00',
                'description' => 'DEL EXTERIOR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.02.00.00.00',
                'description' => 'ARRENDAMIENTOS FINANCIEROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.03.00.00.00',
                'description' => 'DOCUMENTOS POR COBRAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.03.01.00.00',
                'description' => 'DOCUMENTOS POR COBRAR CON GARANTIA REAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.03.02.00.00',
                'description' => 'DOCUMENTOS POR COBRAR SIN GARANTIA REAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.04.00.00.00',
                'description' => 'SUSCRIPTORES DE ACCIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.04.01.00.00',
                'description' => 'ACCIONISTAS FUNDADORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.04.01.01.00',
                'description' => 'MAXIMILIANO GUILLERMO NOVOA CHAVEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.05.00.00.00',
                'description' => 'PRESTAMOS A LOS ACCIONISTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.05.01.00.00',
                'description' => 'ACCIONISTAS FUNDADORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.05.01.01.00',
                'description' => 'MAXIMILIANO GUILLERMO NOVOA CHAVEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.05.01.02.00',
                'description' => 'ORLANDO JOSE LLOVERA ZEPEDA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.05.01.03.00',
                'description' => 'JOSE TOMAS PERALTA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.05.01.04.00',
                'description' => 'DIRECTORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.00.00.00',
                'description' => 'ANTICIPOS Y PRESTAMOS AL PERSONAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.06.01.00.00',
                'description' => 'PERSONAL DE ADMINISTRACION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.06.01.01.00',
                'description' => 'NELSON JAIME VILLALTA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.01.02.00',
                'description' => 'WENDY DAHBURA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.00.00',
                'description' => 'PERSONAL DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.06.02.01.00',
                'description' => 'ANA TERESA DE LEON', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.02.00',
                'description' => 'GRISELDA RIVERA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.03.00',
                'description' => 'ANA MEYLIN RAMIREZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.04.00',
                'description' => 'CARMEN LLOVERA ZEPEDA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.05.00',
                'description' => 'GABRIEL RODRIGUEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.06.00',
                'description' => 'CARLOS ELIAS KARRAA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.07.00',
                'description' => 'FRANCELLY CECILIA RODIL CASTILLO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.02.08.00',
                'description' => 'ANA PATRICIA GARCIA INGLES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.00.00',
                'description' => 'PERSONAL DE PRODUCCION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.06.03.01.00',
                'description' => 'RONALD MARTINEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.02.00',
                'description' => 'JULIO CESAR RAMOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.03.00',
                'description' => 'LUIS ESPERANZA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.04.00',
                'description' => 'DOMINGO HUEZO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.05.00',
                'description' => 'MIGUEL RAMOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.06.00',
                'description' => 'MARVIN SANCHEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.07.00',
                'description' => 'ALBERTO VENTURA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.08.00',
                'description' => 'DARVIN LEMUS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.09.00',
                'description' => 'ERICK PANAMEÑO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.10.00',
                'description' => 'JOSE ROBERTO BERNAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.11.00',
                'description' => 'JORGE BATRES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.12.00',
                'description' => 'EDWIN ANTONIO GARCIA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.13.00',
                'description' => 'OSCAR ALBERTO HERNANDEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.14.00',
                'description' => 'PEDRO JOSE RIVERA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.15.00',
                'description' => 'OTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.16.00',
                'description' => 'LUIS ALONSO VEGA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.17.00',
                'description' => 'CARLOS BOTTO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.18.00',
                'description' => 'CARLOS MELENDEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.06.03.19.00',
                'description' => 'PEDRO AGUILAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.07.00.00.00',
                'description' => 'DEUDORES VARIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.07.01.00.00',
                'description' => 'PAGOS POR CUENTA AJENA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.07.02.00.00',
                'description' => 'OTROS PRESTAMOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.07.02.01.00',
                'description' => 'SERGIO LANATA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.07.02.02.00',
                'description' => 'PUBLIMAGZ, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.07.02.03.00',
                'description' => 'PUBLICATE, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.07.02.04.00',
                'description' => 'INTERAMERICAN CARGO LTDA, DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.07.02.05.00',
                'description' => 'Persona Natural', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.08.00.00.00',
                'description' => 'CREDITOS FISCAL IVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.08.01.00.00',
                'description' => 'CREDITOS COMPRAS LOCALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.08.02.00.00',
                'description' => 'CREDITOS IMPORTACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.08.03.00.00',
                'description' => 'CREDITO IVA RETENIDO 1%', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.08.04.00.00',
                'description' => 'REMANENTE CREDITO FISCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.08.05.00.00',
                'description' => 'CREDITO FISCAL POR APLICAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.08.06.00.00',
                'description' => 'CREDITO IVA PERCIBIDO 1%', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.09.00.00.00',
                'description' => 'ANTICIPOS A PROVEEDORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.02.09.01.00.00',
                'description' => 'ANTICIPO PROVEEDORES LOCALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.02.09.02.00.00',
                'description' => 'ANTICIPO PROVEEDORES DEL EXTERIOR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.00.00.00.00',
                'description' => 'CUENTAS POR COBRAR RELACIONADAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.03.01.00.00.00',
                'description' => 'DIRECTORES Y EJECUTIVOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.02.00.00.00',
                'description' => 'COMPAÑIAS CONTROLADORAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.00.00.00',
                'description' => 'COMPAÑIAS ASOCIADAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.03.03.01.00.00',
                'description' => 'GRUPO INMOBILIARIO DVIDA, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.02.00.00',
                'description' => 'URBMAN, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.03.00.00',
                'description' => 'PUBLIMAGEN PANAMA, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.04.00.00',
                'description' => 'PUBLIMOVIL, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.05.00.00',
                'description' => 'PERFILES INTERNACIONALES, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.06.00.00',
                'description' => 'PUBLIMAGEN HONDURAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.07.00.00',
                'description' => 'COLOR TECHNOLOGY GROUP, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.08.00.00',
                'description' => 'PUBLIMOVIL GUATEMALA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.09.00.00',
                'description' => 'PUBLIMOVIL HONDURAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.10.00.00',
                'description' => 'PUBLIMOVIL NICARAGUA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.11.00.00',
                'description' => 'PUBLIMAGEN GUATEMALA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.12.00.00',
                'description' => 'PUBLIMAGEN INVESTMENT GROUP CORP', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.13.00.00',
                'description' => 'PUBLIMAGEN CAPITAL GROUP CORP', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.14.00.00',
                'description' => 'CASEIFF', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.03.15.00.00',
                'description' => 'TOPZ, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.03.04.00.00.00',
                'description' => 'EMPRESAS RELACIONADAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.00.00.00.00',
                'description' => 'INVENTARIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.01.00.00.00',
                'description' => 'EXISTENCIAS DE MERCADERIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.01.01.00.00',
                'description' => 'MERCADERIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.01.02.00.00',
                'description' => 'BIENES DE CAPITAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.02.00.00.00',
                'description' => 'MATERIALES Y SUMINISTROS DIRECTOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.02.01.00.00',
                'description' => 'INVENTARIOS DIRECTOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.02.01.01.00',
                'description' => 'MATERIAS PRIMAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.02.01.02.00',
                'description' => 'SUMINISTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.02.01.03.00',
                'description' => 'REPUESTOS Y ACCESORIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.00.00.00',
                'description' => 'PRODUCTOS TERMINADOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.03.01.00.00',
                'description' => 'IMPRESIONES EN VINYL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.02.00.00',
                'description' => 'IMPRESIONES EN LONA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.03.00.00',
                'description' => 'IMPRESIONES EN PVC', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.04.00.00',
                'description' => 'IMPRESIONES EN COROPLAST', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.05.00.00',
                'description' => 'IMPRESIONES EN POLIESTIRENO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.06.00.00',
                'description' => 'IMPRESIONES EN GLOSSY PAPER', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.07.00.00',
                'description' => 'IMPRESIONES EN ACRILICO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.08.00.00',
                'description' => 'IMPRESIONES EN FOLDCOTE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.09.00.00',
                'description' => 'IMPRESIONES EN WINDOW GRAFIC', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.10.00.00',
                'description' => 'IMPRESIONES EN BACKLIGHT', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.11.00.00',
                'description' => 'TOLDOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.12.00.00',
                'description' => 'INVENTARIO DE IMPRESIONES Y ESTRUCTURAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.13.00.00',
                'description' => 'INVENTARIO DE FABRICACION DE VALLAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.03.14.00.00',
                'description' => 'INVENTARIO DE PRODUCTOS TERMINADOS EN MATERIAL P.O.P.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.04.00.00.00',
                'description' => 'PRODUCTOS EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.04.01.00.00',
                'description' => 'MATERIALES EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.04.02.00.00',
                'description' => 'MANO DE OBRA EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.04.03.00.00',
                'description' => 'INDIRECTOS EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.04.04.00.00',
                'description' => 'INDIRECTOS EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.04.05.00.00',
                'description' => 'MANO DE OBRA EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.06.00.00.00',
                'description' => 'PEDIDOS EN TRANSITO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.06.01.00.00',
                'description' => 'MERCADERIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.06.01.01.00',
                'description' => 'TRANSITO LOCAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.06.01.02.00',
                'description' => 'TRANSITO DEL EXTERIOR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.06.02.00.00',
                'description' => 'BIENES DE CAPITAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.06.02.01.00',
                'description' => 'MAQUINARIA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.06.03.00.00',
                'description' => 'MATERIALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.06.04.00.00',
                'description' => 'SUMINISTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.06.05.00.00',
                'description' => 'REPUESTOS Y ACCESORIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.00.00.00',
                'description' => 'ESTIMACION PARA OBSOLESCENCIA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.01.00.00',
                'description' => 'OBSOLESCENCIA DE MERCADERIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.01.01.00',
                'description' => 'MERCADERIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.00.00',
                'description' => 'OBSOLESCENCIA MATERIALES Y SUMINISTROS D', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.02.01.00',
                'description' => 'DEPARTAMENTO DE DISEÑO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.02.01.01',
                'description' => 'MATERIALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.01.02',
                'description' => 'SUMINISTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.01.03',
                'description' => 'REPUESTOS Y ACCESORIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.02.00',
                'description' => 'DEPARTAMENTO DE IMPRESION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.02.02.01',
                'description' => 'MATERIALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.02.02',
                'description' => 'SUMINISTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.03.00',
                'description' => 'DEPARTAMENTO DE MONTAJE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.02.03.01',
                'description' => 'MATERIALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.02.03.02',
                'description' => 'SUMINISTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.03.00.00',
                'description' => 'OBSOLESCENCIA PRODUCTOS TERMINADOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.04.07.03.01.00',
                'description' => 'IMPRESIONES EN VINYL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.03.02.00',
                'description' => 'IMPRESIONES EN LONA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.04.07.03.03.00',
                'description' => 'IMPRESIONES EN PVC', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.00.00.00.00',
                'description' => 'INVERSIONES TEMPORALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.01.00.00.00',
                'description' => 'TITULOS Y VALORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.01.01.00.00',
                'description' => 'INVERSIONES EN SOCIEDADES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.01.01.01.00',
                'description' => 'ACCIONES PREFERENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.00',
                'description' => 'ACCIONES COMUNES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.01.01.02.01',
                'description' => 'PUBLI 3D, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.02',
                'description' => 'COLOR TECHNOLOGY GROUP, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.03',
                'description' => 'PUBLIMAGEN PANAMA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.04',
                'description' => 'PUBLIMAGEN HONDURAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.05',
                'description' => 'PUBLIMAGEN INVESTMENT', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.06',
                'description' => 'QUEDEX, S.A DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.07',
                'description' => 'Grupo HASGAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.08',
                'description' => 'Grupo ZABLAH', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.01.02.09',
                'description' => 'Towco, S.A de C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.02.00.00',
                'description' => 'OTRAS INVERSIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.01.02.01.00',
                'description' => 'BONOS DEL GOBIERNO CENTRAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.02.02.00',
                'description' => 'CERTIFICADOS DE INVERSION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.01.02.03.00',
                'description' => 'TITULOS DE CAPITALIZACION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.02.00.00.00',
                'description' => 'PROPIEDADES DE INVERSION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.02.01.00.00',
                'description' => 'TERRENOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.02.01.01.00',
                'description' => 'RUSTICOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.02.01.02.00',
                'description' => 'URBANOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.02.02.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.05.02.02.01.00',
                'description' => 'SISTEMA MIXTO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.02.02.02.00',
                'description' => 'OTROS SISTEMAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.05.02.03.00.00',
                'description' => 'MAQUINARIA Y EQUIPOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.00.00.00.00',
                'description' => 'GASTOS ANTICIPADOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.06.01.00.00.00',
                'description' => 'SEGUROS ANTICIPADOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.06.01.01.00.00',
                'description' => 'COBERTURAS.MERCADERIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.01.02.00.00',
                'description' => 'COBERTURAS.VEHICULOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.01.03.00.00',
                'description' => 'COBERTURAS.EFECTIVO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.01.04.00.00',
                'description' => 'COBERTURAS.INCENDIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.01.05.00.00',
                'description' => 'COBERTURAS.ROBOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.01.06.00.00',
                'description' => 'COBERTURAS.VIDA Y MEDICO HOSPITALARIO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.02.00.00.00',
                'description' => 'RENTAS ANTICIPADAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.06.02.01.00.00',
                'description' => 'OFICINA ADMINISTRATIVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.02.02.00.00',
                'description' => 'SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.02.03.00.00',
                'description' => 'PLANTA DE PRODUCCION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.03.00.00.00',
                'description' => 'PAPELERIA Y UTILES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.06.03.01.00.00',
                'description' => 'PAPELERIA LEGAL.IVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.03.02.00.00',
                'description' => 'PAPELERIA ADMINISTRATIVA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.00.00.00',
                'description' => 'COMBUSTIBLE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.06.04.01.00.00',
                'description' => 'Denis Manuel Flores Quintanilla', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.02.00.00',
                'description' => 'Frank Deybi Chevez Lainez', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.03.00.00',
                'description' => 'Pedro Antonio Aguilar', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.04.00.00',
                'description' => 'Jose Feliciano Sagastume', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.05.00.00',
                'description' => 'Marcos Antonio Mendez', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.06.00.00',
                'description' => 'Orlanco Jose Llovera', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.07.00.00',
                'description' => 'Juan Francisco Valencia Nuila', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.08.00.00',
                'description' => 'Manuel de Jesus Orellana Nieto', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.09.00.00',
                'description' => 'Yobany Alexander Galdamez Serrano', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.10.00.00',
                'description' => 'Blanca Edelmira Aparicio de Rosales', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.11.00.00',
                'description' => 'Inspección No Intusiva Import.Export', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.06.04.12.00.00',
                'description' => 'INVERSIONES CHEVRON, S.A DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.07.00.00.00.00',
                'description' => 'PAGO A CUENTA DE IMPUESTOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.07.01.00.00.00',
                'description' => 'PAGO A CUENTA RENTA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.07.01.01.00.00',
                'description' => 'EJERCICIO 2008', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.07.01.02.00.00',
                'description' => 'EJERCICIO 2009', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.07.01.03.00.00',
                'description' => 'PAGO A CUENTA CORR. AL PRESENTE PERIODO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.07.01.04.00.00',
                'description' => 'RETENCION POR USO O CONCESION DE USO DE DERECHOS DE BIENES T', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.07.01.05.00.00',
                'description' => 'EXCEDENTE DE  PAGO A CUENTA RENTA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.07.02.00.00.00',
                'description' => 'IMPUESTO PARA EL CONTROL DE LIQUIDEZ', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.08.00.00.00.00',
                'description' => 'CARGOS POR APLICAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.1.08.01.00.00.00',
                'description' => 'VARIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.08.02.00.00.00',
                'description' => 'EXACTUS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.08.03.00.00.00',
                'description' => 'HONORARIOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.08.04.00.00.00',
                'description' => 'MATERIALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.1.08.05.00.00.00',
                'description' => 'CUENTAS POR COBRAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.00.00.00.00.00',
                'description' => 'ACTIVOS NO CORRIENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.01.00.00.00.00',
                'description' => 'EFECTIVO Y EQUIVALENTES RESTRINGIDOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.01.01.00.00.00',
                'description' => 'DEPOSITOS A PLAZO FIJO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.01.02.00.00.00',
                'description' => 'CUENTAS RENTABLES EN BOLSA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.02.00.00.00.00',
                'description' => 'CUENTAS POR COBRAR DE LARGO PLAZO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.02.01.00.00.00',
                'description' => 'CUENTAS POR COBRAR LOCALES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.02.01.01.00.00',
                'description' => 'CUENTAS CON GARANTIA REAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.02.01.02.00.00',
                'description' => 'CUENTAS SIN GARANTIA REAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.02.01.03.00.00',
                'description' => 'OTRAS CUENTAS POR COBRAR A L.P', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.02.02.00.00.00',
                'description' => 'CUENTAS POR COBRAR DEL EXTERIOR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.02.02.01.00.00',
                'description' => 'CUENTAS CON GARANTIA REAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.02.02.02.00.00',
                'description' => 'CUENTAS SIN GARANTIA REAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.02.03.00.00.00',
                'description' => 'ARRENDAMIENTOS FINANCIEROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.03.00.00.00.00',
                'description' => 'PARTES RELACIONADAS A LARGO PLAZO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.03.01.00.00.00',
                'description' => 'DIRECTORES Y EJECUTIVOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.03.02.00.00.00',
                'description' => 'COMPAÑIAS CONTROLADORAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.03.03.00.00.00',
                'description' => 'COMPAÑIAS ASOCIADAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.00.00.00.00',
                'description' => 'INVERSIONES PERMANENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.01.00.00.00',
                'description' => 'TITULOS Y VALORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.01.01.00.00',
                'description' => 'INVERSIONES EN SOCIEDADES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.01.01.01.00',
                'description' => 'ACCIONES PREFERENTES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.01.01.02.00',
                'description' => 'ACCIONES COMUNES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.01.02.00.00',
                'description' => 'OTRAS INVERSIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.01.02.01.00',
                'description' => 'BONOS DEL GOBIERNO CENTRAL', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.01.02.02.00',
                'description' => 'CERTIFICADOS DE INVERSION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.01.02.03.00',
                'description' => 'TITULOS DE CAPITALIZACION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.02.00.00.00',
                'description' => 'PROPIEDADES DE INVERSION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.02.01.00.00',
                'description' => 'TERRENOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.02.01.01.00',
                'description' => 'RUSTICOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.02.01.02.00',
                'description' => 'URBANOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.02.02.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.02.02.01.00',
                'description' => 'SISTEMA MIXTO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.02.02.02.00',
                'description' => 'OTROS SISTEMAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.02.03.00.00',
                'description' => 'MAQUINARIA Y EQUIPOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.03.00.00.00',
                'description' => 'PROPIEDADES EN ARRENDAMIENTO FINANCIERO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.03.01.00.00',
                'description' => 'TERRENOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.03.01.01.00',
                'description' => 'RUSTICOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.03.01.02.00',
                'description' => 'URBANOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.03.02.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.04.03.02.01.00',
                'description' => 'SISTEMA MIXTO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.03.02.02.00',
                'description' => 'OTROS SISTEMAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.04.03.03.00.00',
                'description' => 'MAQUINARIA Y EQUIPOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.00.00.00.00',
                'description' => 'PROPIEDAD PLANTA Y EQUIPO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.05.01.00.00.00',
                'description' => 'TERRENOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.02.00.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.03.00.00.00',
                'description' => 'INSTALACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.04.00.00.00',
                'description' => 'REVALUACION DE BIENES INMUEBLES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.05.04.01.00.00',
                'description' => 'TERRENOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.04.02.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.04.03.00.00',
                'description' => 'INSTALACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.05.00.00.00',
                'description' => 'CONSTRUCCIONES EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.06.00.00.00',
                'description' => 'MOBILIARIO Y EQUIPO DE OFICINA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.05.06.03.00.00',
                'description' => 'PLANTA DE PRODUCCION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.07.00.00.00',
                'description' => 'MOBILIARIO Y EQUIPO DE SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.08.00.00.00',
                'description' => 'MAQUINARIA Y EQUIPO DE PRODUCCION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.09.00.00.00',
                'description' => 'VEHICULOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.10.00.00.00',
                'description' => 'HERRAMIENTAS Y EQUIPO PEQUEÑO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.11.00.00.00',
                'description' => 'REVALUACION DE BIENES MUEBLES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.05.11.01.00.00',
                'description' => 'MOBILIARIO Y EQUIPO DE OFICINA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.11.02.00.00',
                'description' => 'MOBILIARIO Y EQUIPO SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.11.03.00.00',
                'description' => 'MAQUINARIA Y EQUIPO DE PRODUCCION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.11.04.00.00',
                'description' => 'VEHICULOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.11.05.00.00',
                'description' => 'HERRAMIENTAS Y EQUIPO PEQUEÑO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.12.00.00.00',
                'description' => 'BIENES CORPORALES EN TRANSITO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.13.00.00.00',
                'description' => 'BIENES EN ARRENDAMIENTO FINANCIERO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.05.13.01.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.13.02.00.00',
                'description' => 'INSTALACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.13.03.00.00',
                'description' => 'MOBILIARIO Y EQUIPO DE OFICINA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.13.04.00.00',
                'description' => 'MOBILIARIO Y EQUIPO SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.13.05.00.00',
                'description' => 'MAQUINARIA Y EQUIPO DE PRODUCCION', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.14.00.00.00',
                'description' => 'EQUIPO DE COMPUTO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.05.15.00.00.00',
                'description' => 'EXHIBIDORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.00.00.00.00',
                'description' => 'DEPRECIACION ACUMULADA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.06.01.00.00.00',
                'description' => 'DEPRECIACION EDIFICACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.02.00.00.00',
                'description' => 'DEPRECIACION INSTALACIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.03.00.00.00',
                'description' => 'DEPRECIACION M. Y EQUIPO DE OFICINA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.04.00.00.00',
                'description' => 'DEPRECIACION M. Y EQUIPO SALAS DE VENTAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.05.00.00.00',
                'description' => 'DEPRECIACION MAQUINARIA Y EQ. DE PRODUCC', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.06.00.00.00',
                'description' => 'DEPRECIACION VEHICULOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.07.00.00.00',
                'description' => 'DEPRECIACION HERRAMIENTAS Y EQ. PEQUEÑO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.08.00.00.00',
                'description' => 'DEPRECIACION BIENES EN A.F.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.09.00.00.00',
                'description' => 'DEPRECIACION EQUIPO DE COMPUTO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.06.10.00.00.00',
                'description' => 'DEPRECIACION DE EXHIBIDORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.00.00.00.00',
                'description' => 'DERECHOS, PATENTES Y OTROS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.08.01.00.00.00',
                'description' => 'DERECHOS DE LLAVE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.02.00.00.00',
                'description' => 'PATENTES Y MARCAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.03.00.00.00',
                'description' => 'LICENCIAS Y CONCESIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.04.00.00.00',
                'description' => 'AMORTIZACION SOBRE INTANGIBLES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.08.04.01.00.00',
                'description' => 'AMORTIZACION DERECHOS DE LLAVE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.04.02.00.00',
                'description' => 'AMORTIZACION PATENTES Y MARCAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.04.03.00.00',
                'description' => 'AMORTIZACION LICENCIAS Y CONSECIONES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.08.05.00.00.00',
                'description' => 'BIENES INTANGIBLES EN PROCESO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.00.00.00.00',
                'description' => 'DEPOSITOS EN GARANTIA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.09.01.00.00.00',
                'description' => 'GARANTIAS POR FACTORAJE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.09.01.01.00.00',
                'description' => 'CHEQUES EN GARANTIA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.09.01.01.01.00',
                'description' => 'PENTAGONO, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.02.00',
                'description' => 'LAFISE', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.03.00',
                'description' => 'QUEDEX, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.04.00',
                'description' => 'IICA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.05.00',
                'description' => 'Alcaldia Municipal de Santa Tecla', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.06.00',
                'description' => 'Grupo Inmobiliario D´Vida, S.A. de C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.07.00',
                'description' => 'Bolsa de Productos de El Salvador, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.01.08.00',
                'description' => 'INFRA DE EL SALVADOR, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.00.00',
                'description' => 'QUEDAN EN GARANTIA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.09.01.02.01.00',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.02.00',
                'description' => 'PENTAGONO, S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.03.00',
                'description' => 'BANCO DE AMERICA CENTRAL, S.A.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.04.00',
                'description' => 'BANCO LAFISE PANAMA', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.05.00',
                'description' => 'QUEDEX', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.06.00',
                'description' => 'GRUPO INMOBILIARIO DVIDA,S.A. DE C.V.', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.01.02.07.00',
                'description' => 'PUBLIHOLDING', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.09.02.00.00.00',
                'description' => 'GARANTIAS POR SERVICIOS BASICOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.10.00.00.00.00',
                'description' => 'ACTIVOS DIFERIDOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'1.2.10.01.00.00.00',
                'description' => 'OTROS DIFERIDOS POR AMORTIZAR', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'1.2.11.00.00.00.00',
                'description' => 'ACTIVO POR IMPUESTO DIFERIDO', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.0.00.00.00.00.00',
                'description' => 'PASIVO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.00.00.00.00.00',
                'description' => 'PASIVOS CORRIENTES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.01.00.00.00.00',
                'description' => 'CUENTAS POR PAGAR COMERCIALES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.01.01.00.00.00',
                'description' => 'PROVEEDORES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.01.01.01.00.00',
                'description' => 'PROVEEDORES LOCALES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.01.02.00.00',
                'description' => 'PROVEEDORES DEL EXTERIOR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.02.00.00.00',
                'description' => 'ACREEDORES VARIOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.01.02.01.00.00',
                'description' => 'ACREEDORES LOCALES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.02.02.00.00',
                'description' => 'ACREEDORES DEL EXTERIOR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.03.00.00.00',
                'description' => 'DOCUMENTOS POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.01.03.01.00.00',
                'description' => 'CONTRATOS A PLAZO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.01.03.01.01.00',
                'description' => 'AUTOFACIL, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.03.01.02.00',
                'description' => 'CREDI Q, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.03.01.03.00',
                'description' => 'GANDIINNOVATIONS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.03.02.00.00',
                'description' => 'CARTAS DE CREDITO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.01.03.03.00.00',
                'description' => 'COBRANZAS DEL EXTERIOR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.00.00.00.00',
                'description' => 'GASTOS Y ENTEROS POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.02.01.00.00.00',
                'description' => 'PROVISIONES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.02.01.01.00.00',
                'description' => 'SEGURO SOCIAL PATRONAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.02.00.00',
                'description' => 'AFPS PATRONAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.03.00.00',
                'description' => 'COMISIONES POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.04.00.00',
                'description' => 'PLANILLAS POR LIQUIDAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.05.00.00',
                'description' => 'VACACIONES Y AGUINALDOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.06.00.00',
                'description' => 'MOD por Sub.Contratacion', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.07.00.00',
                'description' => 'PAGO A CUENTA RENTA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.08.00.00',
                'description' => 'IVA POR ENTERAR DEL PERIODO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.09.00.00',
                'description' => 'RENTA RETENIDA POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.10.00.00',
                'description' => 'IPSFA PATRONAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.01.11.00.00',
                'description' => 'COMBUSTIBLE POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.00.00.00',
                'description' => 'RETENCIONES LEGALES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.02.02.01.00.00',
                'description' => 'COTIZACIONES ISSS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.02.00.00',
                'description' => 'RETENCIONES IVA A TERCEROS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.03.00.00',
                'description' => 'IMPUESTOS SOBRE LA RENTA EMPLEADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.04.00.00',
                'description' => 'ISR SIN DEPENDENCIA LABORAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.05.00.00',
                'description' => 'PRESTAMOS BANCOS E INST. FINANCIERAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.06.00.00',
                'description' => 'VIALIDADES EMPLEADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.07.00.00',
                'description' => 'PROCURADURIA GENERAL DE LA REPUBLICA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.08.00.00',
                'description' => 'FONDO DE PENSIONES (AFPS)', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.09.00.00',
                'description' => 'OTRAS RETENCIONES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.02.10.00.00',
                'description' => 'FONDO SOCIAL PARA LA VIVIENDA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.03.00.00.00',
                'description' => 'DEBITOS FISCALES.IVA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.02.03.01.00.00',
                'description' => 'DEBITOS VENTAS CONSUMIDORES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.03.02.00.00',
                'description' => 'DEBITOS CONTRIBUYENTES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.03.03.00.00',
                'description' => '1% RETENCION IVA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.02.03.04.00.00',
                'description' => 'RETENCION DE IVA NO DOMICILIADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.03.00.00.00.00',
                'description' => 'CUENTAS POR PAGAR ACCIONISTAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.03.01.00.00.00',
                'description' => 'DIVIDENDOS POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.03.01.01.00.00',
                'description' => 'POR UTILIDADES DE OPERACION', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.03.01.02.00.00',
                'description' => 'POR UTILIDADES DE CAPITAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.03.02.00.00.00',
                'description' => 'PRESTAMOS A ACCIONISTAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.03.02.01.00.00',
                'description' => 'ACCIONISTAS FUNDADORES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.03.02.01.01.00',
                'description' => 'JOSE TOMAS PERALTA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.03.02.02.00.00',
                'description' => 'OTROS ACCIONISTAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.00.00.00.00',
                'description' => 'CUENTAS POR PAGAR SISTEMA FINANCIERO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.01.00.00.00',
                'description' => 'SOBREGIROS BANCARIOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.01.01.00.00',
                'description' => 'SOBREGIROS AUTORIZADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.01.02.00.00',
                'description' => 'SOBREGIROS NO AUTORIZADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.01.02.01.00',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.01.02.02.00',
                'description' => 'BANCO AGRICOLA, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.01.02.03.00',
                'description' => 'BANCO DE AMERICA CENTRAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.00.00.00',
                'description' => 'PRESTAMOS BANCARIOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.02.01.00.00',
                'description' => 'LINEAS DE INVERSION', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.02.00.00',
                'description' => 'LINEAS DE CAPITAL DE TRABAJO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.02.02.01.00',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.02.02.00',
                'description' => 'LA CENTRAL DE SEGUROS Y FIANZAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.02.03.00',
                'description' => 'BANCO ATLANTIDA,S.A', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.02.04.00',
                'description' => 'QUEDEX, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.02.05.00',
                'description' => 'FIREMPRESA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.02.06.00',
                'description' => 'Decreciente Banco Industrial, S.A', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.03.00.00',
                'description' => 'LINEAS DE EXPORTACION', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.00.00',
                'description' => 'LINEAS ROTATIVAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.02.04.01.00',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.02.00',
                'description' => 'FACTORAJE ROTATIVA.QUEDEX', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.03.00',
                'description' => 'QUEDEX, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.04.00',
                'description' => 'FACTORAJE ROTATIVA.GRUPO INMOBILIARIO DVIDA, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.05.00',
                'description' => 'FACTORAJE ROTATIVA.PUBLIHOLDING GROUP CORP.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.06.00',
                'description' => 'ROTATIVA BANCO INDUSTRIAL, S.A', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.04.07.00',
                'description' => 'ROTATIVA BANCO ATLANTIDA, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.00.00',
                'description' => 'DOCUMENTOS DESCONTADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.02.05.01.00',
                'description' => 'BANCO CITIBANK DE EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.02.00',
                'description' => 'PENTAGONO, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.03.00',
                'description' => 'BANCO DE AMERICA CENTRAL, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.04.00',
                'description' => 'DOCUMENTOS COBRADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.05.00',
                'description' => 'BANCO LAFISE PANAMA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.06.00',
                'description' => 'QUEDEX, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.07.00',
                'description' => 'GRUPO INMOBILIARIO DVIDA, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.08.00',
                'description' => 'CHEQUES EN TRANSITO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.02.05.08.01',
                'description' => 'Quedex, S.A. de C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.08.02',
                'description' => 'Grupo Inmobiliario D´Vida, S.A. de C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.08.03',
                'description' => 'Publiholding Corp', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.05.09.00',
                'description' => 'PUBLIHOLDING GROUP', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.06.00.00',
                'description' => 'TARJETAS DE CREDITO EMPRESARIAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.02.06.01.00',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.02.06.02.00',
                'description' => 'CITI COMPRAS INSTITUCIONALES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.03.00.00.00',
                'description' => 'INTERESES POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.04.03.01.00.00',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.03.02.00.00',
                'description' => 'LA CENTRAL DE SEGUROS Y FIANZAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.03.03.00.00',
                'description' => 'BANCO DE AMERICA CENTRAL, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.03.04.00.00',
                'description' => 'INTS X PAGAR QUEDEX, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.03.05.00.00',
                'description' => 'FACTORAJE ROTATIVA.GRUPO INMOBILIARIO DVIDA, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.04.03.06.00.00',
                'description' => 'FACTORAJE ROTATIVA.PUBLIHOLDING GROUP CORP.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.05.00.00.00.00',
                'description' => 'IMPUESTOS POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.05.01.00.00.00',
                'description' => 'DIRECCION GENERAL DE TESORERIA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.05.01.01.00.00',
                'description' => 'IMPUESTO SOBRE LA RENTA CORRIENTE', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.05.01.02.00.00',
                'description' => 'DIFERIDO POR IMPUESTO SOBRE LA RENTA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.05.01.03.00.00',
                'description' => 'IMPUESTO POR IMPORTACIONES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.05.02.00.00.00',
                'description' => 'ALCALDIA MUNICIPAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.05.02.01.00.00',
                'description' => 'ALUMBRADO Y ASEO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.05.02.02.00.00',
                'description' => 'IMPUESTOS MUNICIPALES CUENTA COMERCIAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.05.02.03.00.00',
                'description' => 'ROTULOS Y SIMILARES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.06.00.00.00.00',
                'description' => 'PASIVOS CON PARTES RELACIONADAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.06.01.00.00.00',
                'description' => 'DIRECTORES Y EJECUTIVOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.06.02.00.00.00',
                'description' => 'COMPAÑIAS CONTROLADORAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.06.03.00.00.00',
                'description' => 'COMPAÑIAS ASOCIADAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.06.03.01.00.00',
                'description' => 'PUBLIMOVIL, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.06.03.02.00.00',
                'description' => 'PUBLIMAGEN CAPITAL PANAMA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.06.04.00.00.00',
                'description' => 'COMPAÑIAS RELACIONADAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.07.00.00.00.00',
                'description' => 'CONTRATOS POR PAGAR ARRENDAMIENTOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.07.01.00.00.00',
                'description' => 'PORCION CORRIENTE ARREND. FINANCIERO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.07.01.02.00.00',
                'description' => 'LEASING ALL, S.A DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.07.02.00.00.00',
                'description' => 'PORCION CORRIENTE ARREND. OPERATIVO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.00.00.00.00',
                'description' => 'OTRAS CUENTAS POR PAGAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.1.08.01.00.00.00',
                'description' => 'AGENCIAS PUBLICITARIAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.02.00.00.00',
                'description' => 'SEGUROS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.03.00.00.00',
                'description' => 'CARGOS POR LIQUIDAR FLETE POR EXPORT', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.04.00.00.00',
                'description' => 'ROMERO & PINEDA ASOCIADOS, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.05.00.00.00',
                'description' => 'Auditoria Externa', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.06.00.00.00',
                'description' => 'FELIX RODOLFO MONCADA MALDONADO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.07.00.00.00',
                'description' => 'FUNCIONARIOS Y EMPLEADOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.08.00.00.00',
                'description' => 'GRUPO INMOBILIARIO DVIDA, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.09.00.00.00',
                'description' => 'Cheques Post.Fechados Ptes de Cobrar', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.10.00.00.00',
                'description' => 'Jaime Salvador Zaldaña Ghia', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.11.00.00.00',
                'description' => 'PROV. ATENCION A CLIENTES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.12.00.00.00',
                'description' => 'PROV. DE CAPACITACIONES AL PERSONAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.13.00.00.00',
                'description' => 'PROV. DE ATENCIONES AL PERSONAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.14.00.00.00',
                'description' => 'PROV. DE SERVICIOS BASICOS DE AGUA POTABLE', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.15.00.00.00',
                'description' => 'PROV. DE SERVICIOS BASICOS DE ENERGIA ELECTRICA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.16.00.00.00',
                'description' => 'PROV. DE MATRICULA DE VEHICULOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.17.00.00.00',
                'description' => 'PROV. DE SERVICIOS BASICOS DE TELEFONIA FIJA Y CELULAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.18.00.00.00',
                'description' => 'PROV. DE SERVICIOS DE HONORARIOS LEGALES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.19.00.00.00',
                'description' => 'CENTRO NACIONAL DE REGISTROS (CNR)', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.20.00.00.00',
                'description' => 'MANTENIMIENTO DE MAQUINARIA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.21.00.00.00',
                'description' => 'MANTENIMIENTO DE VEHICULOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.22.00.00.00',
                'description' => 'HERRAMIENTAS Y EQUIPOS DE SEGURIDAD', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.23.00.00.00',
                'description' => 'CUOTAS Y SUSCRIPCIONES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.24.00.00.00',
                'description' => 'CAJA CHICA POR LIQUIDAR', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.25.00.00.00',
                'description' => 'Prov. Ctas Incobrables', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.26.00.00.00',
                'description' => 'CARGOS POR LIQUIDAR SEGURO DE EXPORT', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.1.08.27.00.00.00',
                'description' => 'CARGOS POR LIQUIDAR IMPUESTOS DE EXPORT', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.00.00.00.00.00',
                'description' => 'PASIVOS NO CORRIENTES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.00.00.00.00',
                'description' => 'PRESTAMOS DE LARGO PLAZO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.01.00.00.00',
                'description' => 'PRESTAMOS HIPOTECARIOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.01.01.00.00',
                'description' => 'BANCOS DEL SISTEMA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.01.02.00.00',
                'description' => 'INSTITUCIONES FINANCIERAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.01.03.00.00',
                'description' => 'OTROS ACREEDORES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.00.00.00',
                'description' => 'PRESTAMOS PRENDARIOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.02.01.00.00',
                'description' => 'BANCOS DEL SISTEMA', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.00.00',
                'description' => 'INSTITUCIONES FINANCIERAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.02.02.01.00',
                'description' => 'LINEAS DE INVERSION', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.00',
                'description' => 'LINEAS DE CAPITAL DE TRABAJO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.02.02.02.01',
                'description' => 'BANCO CITIBANK EL SALVADOR, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.02',
                'description' => 'LA CENTRAL DE SEGUROS Y FIANZAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.03',
                'description' => 'BANCO AGRICOLA, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.04',
                'description' => 'QUEDEX, S.A. DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.05',
                'description' => 'HENCORP BECSTONE', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.06',
                'description' => 'BANCO ATLANTIDA, S.A.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.02.02.07',
                'description' => 'FIREMPRESA L.P', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.03.00.00',
                'description' => 'OTROS ACREEDORES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.02.03.01.00',
                'description' => 'AUTOFACIL, S.A. DE C.V. (LP)', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.02.03.02.00',
                'description' => 'CREDI Q, S.A DE C.V. (LP)', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.03.00.00.00',
                'description' => 'CREDITOS ACCIONISTAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.01.03.01.00.00',
                'description' => 'ACCIONISTAS FUNDADORES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.01.03.02.00.00',
                'description' => 'OTROS ACCIONISTAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.02.00.00.00.00',
                'description' => 'PARTES RELACIONADAS A LARGO PLAZO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.02.01.00.00.00',
                'description' => 'DIRECTORES Y EJECUTIVOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.02.02.00.00.00',
                'description' => 'COMPAÑIAS CONTROLADORAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.02.03.00.00.00',
                'description' => 'COMPAÑIAS ASOCIADAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.02.04.00.00.00',
                'description' => 'COMPAÑIAS RELACIONADAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.03.00.00.00.00',
                'description' => 'PASIVO POR RETIRO LABORAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.03.01.00.00.00',
                'description' => 'PROVISION LABORAL', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.03.01.01.00.00',
                'description' => 'PERSONAL DE ADMINISTRACION', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.03.01.01.01.00',
                'description' => 'VACACIONES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.03.01.01.02.00',
                'description' => 'AGUINALDOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.03.01.01.03.00',
                'description' => 'INDEMNIZACIONES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.03.01.02.00.00',
                'description' => 'PERSONAL DE VENTAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.03.01.03.00.00',
                'description' => 'PERSONAL DE PRODUCCION', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.04.00.00.00.00',
                'description' => 'ANTICIPOS Y GARANTIAS RECIBIDOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.04.01.00.00.00',
                'description' => 'ANTICIPOS Y GARANTIAS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.04.01.01.00.00',
                'description' => 'ANTICIPOS DE CLIENTES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.04.01.02.00.00',
                'description' => 'GARANTIAS DE CLIENTES', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.05.00.00.00.00',
                'description' => 'CONTRATOS POR PAGAR ARR. FINANCIERO LP', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.05.01.00.00.00',
                'description' => 'CONTRATOS POR PAGAR ARR. FINANCIERO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.05.01.02.00.00',
                'description' => 'LEASING ALL, S.A DE C.V.', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.05.02.00.00.00',
                'description' => 'CONTRATOS POR PAGAR ARR. OPERATIVO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.06.00.00.00.00',
                'description' => 'IMPUESTOS DIFERIDOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.06.01.00.00.00',
                'description' => 'IMPUESTOS DIFERIDOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'2.2.06.01.01.00.00',
                'description' => 'IMPUESTOS DIRECTOS', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'2.2.07.00.00.00.00',
                'description' => 'PASIVO POR IMPUESTO DIFERIDO', 
                'type_account' =>'P', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.0.00.00.00.00.00',
                'description' => 'PATRIMONIO DE LOS ACCIONISTAS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.00.00.00.00.00',
                'description' => 'CAPITAL, SUPERAVIT Y RESULTADOS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.01.00.00.00.00',
                'description' => 'CAPITAL SOCIAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.01.01.00.00.00',
                'description' => 'CAPITAL SOCIAL SUSCRITO PAGADO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.01.01.01.00.00',
                'description' => 'CAPITAL SOCIAL MINIMO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.01.01.01.01.00',
                'description' => 'PUBLIHOLDING GROUP CORPORATION INC', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.01.02.00',
                'description' => 'ORLANDO JOSE LLOVERA ZEPEDA', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.01.03.00',
                'description' => 'MAXIMILIANO GUILLERMO NOVOA CHAVEZ', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.01.04.00',
                'description' => 'PUBLIMAGEN CAPITAL GROUP CORP', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.00.00',
                'description' => 'CAPITAL SOCIAL VARIABLE', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.01.01.02.01.00',
                'description' => 'PERFILES INTERNACIONALES, S.A. DE C.V.', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.02.00',
                'description' => 'PUBLIHOLDING GROUP CORPORATION INC', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.03.00',
                'description' => 'ORLANDO JOSE LLOVERA ZEPEDA', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.04.00',
                'description' => 'MAXIMILIANO GUILLERMO NOVOA CHAVEZ', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.05.00',
                'description' => 'PUBLIMAGEN CAPITAL GROUP CORP', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.06.00',
                'description' => 'PUBLIMAGEN INVESTMENT GROUP CORP', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.01.02.07.00',
                'description' => 'CONEMITE INTERNATIONAL CORP', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.02.00.00.00',
                'description' => 'CAPITAL SOCIAL SUSCRITO NO PAGADO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.01.02.01.00.00',
                'description' => 'CAPITAL SOCIAL MINIMO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.01.02.02.00.00',
                'description' => 'CAPITAL SOCIAL VARIABLE', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.00.00.00.00',
                'description' => 'SUPERAVIT POR REVALUACIONES DE ACTIVOS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.02.01.00.00.00',
                'description' => 'REVALUACION DE ACTIVOS FIJOS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.02.01.01.00.00',
                'description' => 'TERRENOS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.02.00.00',
                'description' => 'EDIFICACIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.03.00.00',
                'description' => 'INSTALACIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.04.00.00',
                'description' => 'MOBILIARIO Y EQUIPO DE OFICINA', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.05.00.00',
                'description' => 'MOBILIARIO Y EQUIPO SALAS DE VENTAS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.06.00.00',
                'description' => 'MAQUINARIA Y EQUIPO DE PRODUCCION', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.07.00.00',
                'description' => 'VEHICULOS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.01.08.00.00',
                'description' => 'HERRAMIENTAS Y EQUIPO PEQUEÑO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.02.00.00.00',
                'description' => 'REVALUACION DE ACTIVOS INTANGIBLES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.02.02.01.00.00',
                'description' => 'DERECHO DE LLAVE', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.02.02.00.00',
                'description' => 'PATENTES Y MARCAS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.02.02.03.00.00',
                'description' => 'LICENCIAS Y CONCESIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.03.00.00.00.00',
                'description' => 'UTILIDADES RESTRINGIDAS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.03.01.00.00.00',
                'description' => 'RESERVA LEGAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.03.01.01.00.00',
                'description' => 'DE EJERCICIOS ANTERIORES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.03.01.02.00.00',
                'description' => 'DEL PRESENTE EJERCICIO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.04.00.00.00.00',
                'description' => 'UTILIDADES NO DISTRIBUIDAS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.04.01.00.00.00',
                'description' => 'UTILIDADES DEL EJERCICIO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.04.01.01.00.00',
                'description' => 'UTILIDADES DE OPERACIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.04.01.02.00.00',
                'description' => 'UTILIDADES DE CAPITAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.04.02.00.00.00',
                'description' => 'UTILIDADES EJERCICIOS ANTERIORES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.04.02.01.00.00',
                'description' => 'UTILIDADES DE OPERACIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.04.02.02.00.00',
                'description' => 'UTILIDADES DE CAPITAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.04.03.00.00.00',
                'description' => 'SUPERAVIT REALIZADO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.04.03.01.00.00',
                'description' => 'UTILIDADES DE CAPITAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.05.00.00.00.00',
                'description' => 'PERDIDAS ACUMULADAS', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.05.01.00.00.00',
                'description' => 'PERDIDAS DE EJERCICIOS ANTERIORES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.05.01.01.00.00',
                'description' => 'PERDIDAS DE CAPITAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.05.01.02.00.00',
                'description' => 'PERDIDAS DE OPERACIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.05.02.00.00.00',
                'description' => 'PERDIDAS DEL EJERCICIO', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'3.1.05.02.01.00.00',
                'description' => 'PERDIDAS DE CAPITAL', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.05.02.02.00.00',
                'description' => 'PERDIDAS DE OPERACIONES', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'3.1.06.00.00.00.00',
                'description' => 'EFECTO NIIF', 
                'type_account' => 'K', 
                'type_naturaled' =>'A', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.0.00.00.00.00.00',
                'description' => 'RESULTADOS DEUDORES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.00.00.00.00.00',
                'description' => 'COSTOS Y GASTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.00.00.00.00',
                'description' => 'COSTO DE LO VENDIDO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.01.00.00.00',
                'description' => 'MERCADERIAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.01.01.00.00',
                'description' => 'MATERIAS PRIMAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.02.00.00.00',
                'description' => 'PRODUCTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.02.01.00.00',
                'description' => 'PRODUCTO TERMINADO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.02.02.00.00',
                'description' => 'FABRICACION DE VALLAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.02.03.00.00',
                'description' => 'PRODUCTOS TERMINADOS EN MATERIAL P.O.P.', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.03.00.00.00',
                'description' => 'SERVICIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.03.01.00.00',
                'description' => 'COSTO POR SERVICIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.03.01.01.00',
                'description' => 'Costo Empresas Relacionadas', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.03.01.02.00',
                'description' => 'Costo de Arrendamiento de Espacios Publicitarios', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.03.01.03.00',
                'description' => 'Costo por Prestacion de Servicios', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.01.04.00.00.00',
                'description' => 'ACTIVO FIJO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.01.04.01.00.00',
                'description' => 'MAQUINARIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.00.00.00.00',
                'description' => 'COSTO DE PRODUCCION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.00.00.00',
                'description' => 'COSTO POR ORDENES ESPECIFICAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.00.00',
                'description' => 'DEPARTAMENTO DE PRODUCCION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.01.00',
                'description' => 'MATERIAS PRIMAS Y MATERIALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.01.01',
                'description' => 'MATERIAS PRIMAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.02',
                'description' => 'SUMINISTROS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.03',
                'description' => 'REPUESTOS Y ACCESORIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.04',
                'description' => 'COROPLAST', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.05',
                'description' => 'WINDOWS GRAPHIC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.06',
                'description' => 'OTROS MATERIALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.07',
                'description' => 'SERVICIOS CONTRATADOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.08',
                'description' => 'TINTAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.01.09',
                'description' => 'Contratacion a Terceros', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.00',
                'description' => 'MANO DE OBRA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.02.01',
                'description' => 'SUELDOS Y SALARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.02',
                'description' => 'HORAS EXTRAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.03',
                'description' => 'COMISIONES (BONIFICACIONES)', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.04',
                'description' => 'VACACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.05',
                'description' => 'AGUINALDO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.06',
                'description' => 'INDEMNIZACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.07',
                'description' => 'CUOTA PATRONAL ISSS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.08',
                'description' => 'CUOTA PATRONAL AFP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.02.09',
                'description' => 'MOD por Sub.Contratacion', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.00',
                'description' => 'GASTOS INDIRECTOS DE FABRICACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.03.01',
                'description' => 'SUELDOS Y SALARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.02',
                'description' => 'HORAS EXTRAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.03',
                'description' => 'COMISIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.04',
                'description' => 'SERVICIOS EVENTUALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.05',
                'description' => 'ISSS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.06',
                'description' => 'VACACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.07',
                'description' => 'AGUINALDOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.08',
                'description' => 'INDEMNIZACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.09',
                'description' => 'INSAFORP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.10',
                'description' => 'CUOTAS PATRONALES AFP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.11',
                'description' => 'BONIFICACIONES Y GRATIFICACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.12',
                'description' => 'ATENCIONES AL PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.13',
                'description' => 'CAPACITACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.14',
                'description' => 'VIATICOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.15',
                'description' => 'AGUA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.16',
                'description' => 'ENERGIA ELECTRICA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.17',
                'description' => 'TELEFONO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.18',
                'description' => 'SEGURIDAD PRIVADA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.19',
                'description' => 'ALQUILERES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.20',
                'description' => 'TRANSPORTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.21',
                'description' => 'INTERNET', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.22',
                'description' => 'SEGURO VEHICULO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.23',
                'description' => 'CUOTAS Y SUSCRIPCIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.24',
                'description' => 'IMPUESTOS MUNICIPALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.25',
                'description' => 'DEPRECIACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.26',
                'description' => 'MATTO. MAQUINARIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.27',
                'description' => 'MTTO. INSTALACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.28',
                'description' => 'ASEO Y LIMPIEZA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.29',
                'description' => 'MTTO. DE VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.30',
                'description' => 'COMBUSTIBLE Y LUBRICANTES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.31',
                'description' => 'FOVIAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.32',
                'description' => 'GASTOS NO DEDUCIBLES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.33',
                'description' => 'RENOVACION MATRICULAS VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.34',
                'description' => 'HONORARIOS PROFESIONALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.35',
                'description' => 'TRAMITES ADUANALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.36',
                'description' => 'ALMACENAJE CEPA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.37',
                'description' => 'DIVERSOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.38',
                'description' => 'PAPELERIA Y UTILES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.39',
                'description' => 'MTTO. MOBILIARIO Y EQUIPO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.40',
                'description' => 'Repuestos y Herramientas', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.41',
                'description' => 'LEASING MAQUINARIA Y EQUIPO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.42',
                'description' => 'LEASING VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.43',
                'description' => 'ARRENDAMIENTO DE COPIADORA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.44',
                'description' => 'SEGUROS DE VIDA Y MEDICO HOSPITALARIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.45',
                'description' => 'AMORTIZACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.46',
                'description' => 'SEGUROS CONTRA INCENDIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.47',
                'description' => 'SEGURO DE ROBO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.03.48',
                'description' => 'EQUIPO DE SEGURIDAD', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.04.00',
                'description' => 'COSTOS APLICADOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.04.01',
                'description' => 'Indirectos Aplicados', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.04.02',
                'description' => 'Mano de Obra Aplicada', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.04.03',
                'description' => 'Materiales Varios', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.02.01.01.05.00',
                'description' => 'VARIACION DE COSTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.02.01.01.05.01',
                'description' => 'Variacion de Costo', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.00.00.00.00',
                'description' => 'GASTOS DE OPERACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.00.00.00',
                'description' => 'GASTOS DE VENTA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.01.00.00',
                'description' => 'PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.01.01.00',
                'description' => 'SUELDOS Y SALARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.02.00',
                'description' => 'HONORARIOS PROFESIONALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.03.00',
                'description' => 'VACACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.04.00',
                'description' => 'AGUINALDO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.05.00',
                'description' => 'COMISIONES Y BONIFICACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.06.00',
                'description' => 'COMBUSTIBLE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.07.00',
                'description' => 'DEPRECIACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.08.00',
                'description' => 'CUOTA PATRONAL ISSS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.09.00',
                'description' => 'CUOTA PATRONAL AFP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.10.00',
                'description' => 'BONIFICACIONES Y GRATIFICACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.11.00',
                'description' => 'ATENCION AL PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.12.00',
                'description' => 'CAPACITACION AL PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.13.00',
                'description' => 'SEGUROS DE VIDA Y MEDICO HOSPITALARIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.14.00',
                'description' => 'INDEMNIZACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.15.00',
                'description' => 'HORAS EXTRAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.16.00',
                'description' => 'OTROS GASTOS DE PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.17.00',
                'description' => 'INSAFORP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.01.18.00',
                'description' => 'Sanitización Productos COVID.19', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.00.00',
                'description' => 'SERVICIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.02.01.00',
                'description' => 'AGUA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.02.00',
                'description' => 'ENERGIA ELECTRICA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.03.00',
                'description' => 'SEGUROS ACTIVO FIJO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.04.00',
                'description' => 'ALQUILERES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.05.00',
                'description' => 'ASEO Y LIMPIEZA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.06.00',
                'description' => 'MANTENIMIENTO Y MEJORAS DE LOCAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.07.00',
                'description' => 'MANTENIMIENTO DE INSTALACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.08.00',
                'description' => 'SEGURIDAD Y VIGILANCIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.09.00',
                'description' => 'SEGUROS CONTRA INCENDIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.02.10.00',
                'description' => 'SEGURO DE RESPOSABILIDAD CIVIL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.03.00.00',
                'description' => 'INFORMACION Y COMUNICACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.03.01.00',
                'description' => 'COMUNICACIONES TELEFONO FIJO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.03.02.00',
                'description' => 'COMUNICACIONES TELEFONOS CELULARES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.03.03.00',
                'description' => 'SERVICIO DE INTERNET', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.03.04.00',
                'description' => 'COURIER', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.03.05.00',
                'description' => 'CUOTAS Y SUSCRIPCIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.03.06.00',
                'description' => 'COMUNICACION RADIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.04.00.00',
                'description' => 'TECNOLOGIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.04.01.00',
                'description' => 'MANTENIMIENTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.04.02.00',
                'description' => 'CONTRATOS DE SERVICIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.04.03.00',
                'description' => 'CONSULTORIAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.05.00.00',
                'description' => 'VIATICOS Y TRANSPORTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.05.01.00',
                'description' => 'VIATICOS Y TRANSPORTE LOCALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.05.02.00',
                'description' => 'PASAJE AEREO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.05.03.00',
                'description' => 'VIATICOS EXTERIOR', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.05.04.00',
                'description' => 'GASTOS DE HOTEL EXTERIOR', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.06.00.00',
                'description' => 'HONORARIOS PROFESIONALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.06.01.00',
                'description' => 'HONORARIOS POR SERVICIOS VARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.06.02.00',
                'description' => 'HONORARIOS AUDITORIA EXTERNA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.06.03.00',
                'description' => 'HONORARIOS LEGALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.07.00.00',
                'description' => 'VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.07.01.00',
                'description' => 'MANTENIMIENTO Y REPARACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.07.02.00',
                'description' => 'ARRENDAMIENTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.07.03.00',
                'description' => 'COMBUSTIBLE Y LUBRICANTES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.00.00',
                'description' => 'OTROS GASTOS DE VENTA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.08.01.00',
                'description' => 'PAPELERIA Y UTILES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.02.00',
                'description' => 'PROPAGANDA Y PUBLICIDAD', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.03.00',
                'description' => 'ATENCIONES A CLIENTES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.04.00',
                'description' => 'MTTO. DE MOB. Y EQUIPO DE OFICINA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.05.00',
                'description' => 'GASTOS NO DEDUCIBLES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.06.00',
                'description' => 'DONACIONES Y CONTRIBUCIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.07.00',
                'description' => 'ARRENDAMIENTO DE COPIADORA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.08.00',
                'description' => 'FIANZAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.09.00',
                'description' => 'COMISIONES DE AGENCIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.10.00',
                'description' => 'IMPRESIONES POR PROMOCION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.11.00',
                'description' => 'ACTIVOS MENOS DE $500.00', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.08.12.00',
                'description' => 'DISEÑO Y DESARROLLO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.09.00.00',
                'description' => 'DEPRECIACIONES Y AMORTIZACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.09.01.00',
                'description' => 'DEPRECIACIONES EDIFICACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.09.02.00',
                'description' => 'DEPRECIACIONES MOBILIARIO Y EQUIPO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.09.03.00',
                'description' => 'DEPRECIACIONES VEHICULO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.09.04.00',
                'description' => 'DEPRECIACIONES EQUIPO DE COMPUTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.09.05.00',
                'description' => 'AMORTIZACIONES PROGRAMAS IT', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.09.06.00',
                'description' => 'AMORTIZACIONES OTROS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.10.00.00',
                'description' => 'IMPUESTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.10.01.00',
                'description' => 'IMPUESTOS MUNICIPALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.10.02.00',
                'description' => 'MATRICULA DE COMERCIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.10.03.00',
                'description' => 'FOVIAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.10.04.00',
                'description' => 'MULTAS Y RECARGOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.10.05.00',
                'description' => 'IVA PROPORCIONAL NO DEDUCIBLE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.10.06.00',
                'description' => 'IMPUESTOS Y DERECHOS ADUANALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.01.11.00.00',
                'description' => 'Costos In Doors', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.01.11.01.00',
                'description' => 'Arrendamientos', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.00.00.00',
                'description' => 'GASTOS DE ADMINISTRACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.01.00.00',
                'description' => 'PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.01.01.00',
                'description' => 'SUELDOS Y SALARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.02.00',
                'description' => 'HONORARIOS PROFESIONALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.03.00',
                'description' => 'VACACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.04.00',
                'description' => 'AGUINALDO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.05.00',
                'description' => 'COMISIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.06.00',
                'description' => 'COMBUSTIBLE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.07.00',
                'description' => 'DEPRECIACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.08.00',
                'description' => 'CUOTA PATRONAL ISSS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.09.00',
                'description' => 'CUOTA PATRONAL AFP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.10.00',
                'description' => 'BONIFICACIONES Y GRATIFICACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.11.00',
                'description' => 'ATENCION AL PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.12.00',
                'description' => 'CAPACITACION AL PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.13.00',
                'description' => 'SEGUROS DE VIDA Y MEDICO HOSPITALARIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.14.00',
                'description' => 'INDEMNIZACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.15.00',
                'description' => 'HORAS EXTRAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.16.00',
                'description' => 'OTROS GASTOS DE PERSONAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.17.00',
                'description' => 'INSAFORP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.18.00',
                'description' => 'Atencion a Directores', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.01.19.00',
                'description' => 'Sanitización Productos COVID.19', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.00.00',
                'description' => 'SERVICIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.02.01.00',
                'description' => 'AGUA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.02.00',
                'description' => 'ENERGIA ELECTRICA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.03.00',
                'description' => 'SEGUROS ACTIVO FIJO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.04.00',
                'description' => 'ALQUILERES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.05.00',
                'description' => 'ASEO Y LIMPIEZA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.06.00',
                'description' => 'MTTO Y MEJORAS DE LOCAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.07.00',
                'description' => 'MANTENIMIENTO DE INSTALACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.08.00',
                'description' => 'SEGURIDAD Y VIGILANCIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.02.09.00',
                'description' => 'TRANSPORTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.03.00.00',
                'description' => 'INFORMACION Y COMUNICACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.03.01.00',
                'description' => 'COMUNICACIONES TELEFONO FIJO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.03.02.00',
                'description' => 'COMUNICACIONES TELEFONOS CELULARES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.03.03.00',
                'description' => 'SERVICIO DE INTERNET', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.03.04.00',
                'description' => 'COURIER', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.03.05.00',
                'description' => 'CUOTAS Y SUSCRIPCIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.03.06.00',
                'description' => 'COMUNICACIONES RADIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.04.00.00',
                'description' => 'TECNOLOGIA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.04.01.00',
                'description' => 'MANTENIMIENTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.04.02.00',
                'description' => 'CONTRATOS DE SERVICIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.04.03.00',
                'description' => 'CONSULTORIAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.05.00.00',
                'description' => 'VIATICOS Y TRANSPORTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.05.01.00',
                'description' => 'VIATICOS Y TRANSPORTE LOCALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.05.02.00',
                'description' => 'PASAJE AEREO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.05.03.00',
                'description' => 'VIATICOS EXTERIOR', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.05.04.00',
                'description' => 'GASTOS DE HOTEL EXTERIOR', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.06.00.00',
                'description' => 'HONORARIOS PROFESIONALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.06.01.00',
                'description' => 'HONORARIOS POR SERVICIOS VARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.06.02.00',
                'description' => 'HONORARIOS AUDITORIA EXTERNA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.06.03.00',
                'description' => 'HONORARIOS LEGALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.07.00.00',
                'description' => 'VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.07.01.00',
                'description' => 'MANTENIMIENTO Y REPARACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.07.02.00',
                'description' => 'Leasing de vehículo', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.07.03.00',
                'description' => 'COMBUSTIBLE Y LUBRICANTES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.00.00',
                'description' => 'OTROS GASTOS ADMINISTRATIVOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.08.01.00',
                'description' => 'PAPELERIA Y UTILES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.02.00',
                'description' => 'PROPAGANDA Y PUBLICIDAD', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.03.00',
                'description' => 'ATENCIONES A CLIENTES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.04.00',
                'description' => 'MTTO. DE MOB. Y EQUIPO DE OFICINA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.05.00',
                'description' => 'GASTOS NO DEDUCIBLES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.06.00',
                'description' => 'DONACIONES Y CONTRIBUCIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.07.00',
                'description' => 'ARRENDAMIENTO DE COPIADORA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.08.00',
                'description' => 'FIANZAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.09.00',
                'description' => 'ACTIVOS MENOS DE $500.00', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.10.00',
                'description' => 'SEGUROS CONTRA INCENDIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.11.00',
                'description' => 'SEGUROS DE AUTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.12.00',
                'description' => 'SEGUROS DE ROBO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.13.00',
                'description' => 'SEGUROS DE LEASING CUSCATLAN', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.14.00',
                'description' => 'SEGUROS LA CENTRAL DE FIANZAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.15.00',
                'description' => 'ESTIMACION PARA CUENTAS INCOBRABLES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.16.00',
                'description' => 'DIVERSOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.17.00',
                'description' => 'SERVICIOS EVENTUALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.18.00',
                'description' => 'PROVISION CUENTAS INCOBRABLES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.08.19.00',
                'description' => 'SEGURO DE VIDA COLECTIVO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.09.00.00',
                'description' => 'DEPRECIACIONES Y AMORTIZACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.09.01.00',
                'description' => 'DEPRECIACIONES EDIFICACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.09.02.00',
                'description' => 'DEPRECIACIONES MOBILIARIO Y EQUIPO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.09.03.00',
                'description' => 'DEPRECIACIONES VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.09.04.00',
                'description' => 'DEPRECIACIONES EQUIPO DE COMPUTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.09.05.00',
                'description' => 'AMORTIZACIONES PROGRAMAS IT', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.09.06.00',
                'description' => 'AMORTIZACIONES OTROS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.10.00.00',
                'description' => 'IMPUESTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.03.02.10.01.00',
                'description' => 'IMPUESTOS MUNICIPALES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.10.02.00',
                'description' => 'MATRICULA DE COMERCIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.10.03.00',
                'description' => 'FOVIAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.10.04.00',
                'description' => 'MULTAS Y RECARGOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.10.05.00',
                'description' => 'REGISTRO DE COMERCIO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.03.02.10.06.00',
                'description' => 'IMPUESTO DIFERIDO . ACTIVO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.00.00.00.00',
                'description' => 'GASTOS POR FINANCIAMIENTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.00.00.00',
                'description' => 'COMISIONES Y GASTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.01.00.00',
                'description' => 'COMISION DESEMBOLSOS Y ESCRITURACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.01.01.00',
                'description' => 'BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.02.00',
                'description' => 'BANCO AGRICOLA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.03.00',
                'description' => 'BANCO BAC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.04.00',
                'description' => 'BANCO HSBC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.05.00',
                'description' => 'Comisiones Bancarias', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.06.00',
                'description' => 'Comisiones por Desembolso y Escrituración', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.07.00',
                'description' => 'LA CENTRAL DE SEGUROS Y FIANZAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.08.00',
                'description' => 'HENCORP BECSTONE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.01.09.00',
                'description' => 'BANCO ATLANTIDA, S.A.', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.00.00',
                'description' => 'INTERESES PRESTAMOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.01.00',
                'description' => 'INTERESES BANCO BANDESAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.01.01',
                'description' => 'CREDITO DECRECIENTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.01.02',
                'description' => 'LINEAS ROTATIVAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.02.00',
                'description' => 'INTERESES BANCO AGRICOLA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.02.01',
                'description' => 'CREDITO DECRECIENTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.03.00',
                'description' => 'INTERESES BANCO BAC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.04.00',
                'description' => 'INTERESES BANCO HSBC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.05.00',
                'description' => 'INTERESES BANCO INDUSTRIAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.05.01',
                'description' => 'CREDITO DECRECIENTE B.I', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.05.02',
                'description' => 'LINEAS ROTATIVAS B.I', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.06.00',
                'description' => 'INTERESES BANCO G & T', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.07.00',
                'description' => 'INTERESES LA CENTRAL DE SEGUROS Y FIANZA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.07.01',
                'description' => 'CREDITO DECRECIENTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.08.00',
                'description' => 'INTERESES CIAS RELACIONADAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.08.01',
                'description' => 'TOPZ, S.A. DE C.V.', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.08.02',
                'description' => 'PUBLIHOLDING GROUP CORPORATION INC.', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.08.03',
                'description' => 'PUBLIMAGEN CAPITAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.08.04',
                'description' => 'COLOR TECHNOLOGY GROUP', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.08.05',
                'description' => 'GRUPO INMOBILIARIO DVIDA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.08.06',
                'description' => 'Interes Compañía Relacionada', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.09.00',
                'description' => 'INTERESES QUEDEX', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.09.01',
                'description' => 'LINEAS ROTATIVAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.09.02',
                'description' => 'CRÉDITO DECRECIENTE QUEDEX', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.10.00',
                'description' => 'HENCORP BESCTONE CAPITAL, LC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.10.01',
                'description' => 'CREDITO DECRECIENTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.11.00',
                'description' => 'BANCO ATLANTIDA, S.A.', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.02.11.01',
                'description' => 'CREDITO DECRECIENTE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.02.11.02',
                'description' => 'LINEAS ROTATIVAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.00.00',
                'description' => 'COMISION FACTORAJE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.03.01.00',
                'description' => 'BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.02.00',
                'description' => 'BANCO AGRICOLA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.03.00',
                'description' => 'BANCO BAC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.04.00',
                'description' => 'BANCO HSBC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.05.00',
                'description' => 'COMISION POR FACTORAJE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.06.00',
                'description' => 'PENTAGONO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.07.00',
                'description' => 'QUEDEX', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.03.08.00',
                'description' => 'GRUPO INMOBILIARIO DVIDA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.00.00',
                'description' => 'INTERESES FACTORAJE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.01.04.01.00',
                'description' => 'INTERESES BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.02.00',
                'description' => 'INTERESES BANCO AGRICOLA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.03.00',
                'description' => 'INTERESES BANCO BAC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.04.00',
                'description' => 'INTERESES BANCO HSBC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.05.00',
                'description' => 'INTERESES BANCO LAFISE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.06.00',
                'description' => 'INTERESES PENTAGONO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.07.00',
                'description' => 'INTERESES QUEDEX', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.08.00',
                'description' => 'INTERESES DVIDA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.01.04.09.00',
                'description' => 'PUBLIHOLDING GROUP CORPORATION INC.', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.00.00.00',
                'description' => 'CUOTA DE CONTRATO DE ARRENDAMIENTO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.01.00.00',
                'description' => 'CUOTA DE SEGURO DE PRESTAMO Y LEASING', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.01.01.00',
                'description' => 'BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.01.02.00',
                'description' => 'BANCO AGRICOLA', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.01.03.00',
                'description' => 'BANCO BAC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.01.04.00',
                'description' => 'BANCO HSBC', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.01.05.00',
                'description' => 'BANCO LAFISE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.01.06.00',
                'description' => 'PENTAGONO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.02.00.00',
                'description' => 'LEASING VEHICULOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.02.01.00',
                'description' => 'BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.02.02.00',
                'description' => 'AUTOLEASING', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.03.00.00',
                'description' => 'LEASING MAQUINARIA Y EQUIPO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.03.01.00',
                'description' => 'BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.00.00',
                'description' => 'COMISION LEASING', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.04.01.00',
                'description' => 'BANCO CITIBANK', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.02.00',
                'description' => 'BANCO LAFISE', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.03.00',
                'description' => 'AUTOLEASING', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.04.00',
                'description' => 'INTERESES POR SOBREGIRO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.05.00',
                'description' => 'INTERESES TERCEROS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.06.00',
                'description' => 'INTERESES AUTOFACIL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.07.00',
                'description' => 'INTERESES TARJETA DE ORO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.08.00',
                'description' => 'OTRAS COMISIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.09.00',
                'description' => 'OTROS INTERESES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.04.10.00',
                'description' => 'INTERESES CREDI Q', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.05.00.00',
                'description' => 'INTERESES LEASING', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.05.01.00',
                'description' => 'BAC LEASING', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.06.00.00',
                'description' => 'INTERESES ARRENDAMIENTO OPERATIVO', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.06.01.00',
                'description' => 'INTERESES ESPACIOS PUBLICITARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.1.04.02.07.00.00',
                'description' => 'IMPUESTO A LAS OPERACIONES FINANCIERAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.1.04.02.07.01.00',
                'description' => 'IMPUESTO AL CHEQUE Y A LAS TRANSFERENCIAS ELECTRONICAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.2.00.00.00.00.00',
                'description' => 'OTROS GASTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.2.01.00.00.00.00',
                'description' => 'GASTOS EXTRAORDINARIOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.2.01.01.00.00.00',
                'description' => 'GASTOS POR DISCONTINUACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.2.01.02.00.00.00',
                'description' => 'AMORTIZACIONES AUTORIZADAS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.2.01.02.01.00.00',
                'description' => 'PERDIDAS DE CAPITAL', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.2.01.02.02.00.00',
                'description' => 'ACTIVOS INTANGIBLES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.2.01.03.00.00.00',
                'description' => 'GASTOS TERMOFORMADOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.2.01.03.01.00.00',
                'description' => 'GASTOS DE EXPORTACIONES', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.2.01.03.02.00.00',
                'description' => 'OTROS GASTOS DE NO OPERACION', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'4.2.01.04.00.00.00',
                'description' => 'OTROS GASTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'4.2.01.04.01.00.00',
                'description' => 'OTROS GASTOS', 
                'type_account' =>'G', 
                'type_naturaled' =>'D', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.0.00.00.00.00.00',
                'description' => 'RESULTADOS ACREEDORES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.00.00.00.00.00',
                'description' => 'VENTAS, Y SERVICIOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.01.00.00.00.00',
                'description' => 'VENTAS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.01.01.00.00.00',
                'description' => 'MERCADERIAS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.01.01.01.00.00',
                'description' => 'MATERIAS PRIMAS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.01.02.00.00.00',
                'description' => 'PRODUCTOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.01.02.01.00.00',
                'description' => 'PRODUCTOS TERMINADOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.01.02.02.00.00',
                'description' => 'FABRICACION DE VALLAS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.01.02.03.00.00',
                'description' => 'PRODUCTOS TERMINADOS EN MATERIAL P.O.P.', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.01.02.04.00.00',
                'description' => 'Mantenimientos', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.01.02.05.00.00',
                'description' => 'Poductos Terminados', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.01.03.00.00.00',
                'description' => 'ACTIVOS FIJOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.01.03.01.00.00',
                'description' => 'MAQUINARIA', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.00.00.00.00',
                'description' => 'PRODUCTOS FINANCIEROS Y OTROS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.02.01.00.00.00',
                'description' => 'PRODUCTOS FINANCIEROS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.02.01.01.00.00',
                'description' => 'INTERESES GANADOS EN AHORROS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.01.02.00.00',
                'description' => 'INTERESES CORRIENTES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.01.03.00.00',
                'description' => 'INTERESES MORATORIOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.01.04.00.00',
                'description' => 'COMISIONES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.01.05.00.00',
                'description' => 'DIVIDENDOS DEVENGADOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.01.06.00.00',
                'description' => 'INTERESES POR INVERSIONES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.01.07.00.00',
                'description' => 'REPORTOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.02.00.00.00',
                'description' => 'PRODUCTOS VARIOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.02.02.01.00.00',
                'description' => 'SOBRANTES DE CAJA', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.02.02.00.00',
                'description' => 'SUB PRODUCTOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.02.03.00.00',
                'description' => 'ARRENDAMIENTOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.02.04.00.00',
                'description' => 'MISCELANEOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.02.02.05.00.00',
                'description' => 'Facturacion Empresas Afiliadas', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.00.00.00.00',
                'description' => 'SERVICIOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.03.01.00.00.00',
                'description' => 'VENTA DE SERVICIOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.00.00.00',
                'description' => 'ARRENDAMIENTOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.1.03.02.01.00.00',
                'description' => 'ARRENDAMIENTOS BANNER', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.02.00.00',
                'description' => 'ARRENDAMIENTOS ELEVADORES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.03.00.00',
                'description' => 'ARRENDAMIENTOS EXTERIOR', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.04.00.00',
                'description' => 'ARRENDAMIENTOS FASCIA', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.05.00.00',
                'description' => 'ARRENDAMIENTOS GRADAS ELECTRICAS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.06.00.00',
                'description' => 'ARRENDAMIENTOS MACONVE', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.07.00.00',
                'description' => 'ARRENDAMIENTOS MESAS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.08.00.00',
                'description' => 'ARRENDAMIENTOS MURALES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.09.00.00',
                'description' => 'ARRENDAMIENTOS PASARELA', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.10.00.00',
                'description' => 'ARRENDAMIENTOS ROTULOS LUMINOSOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.11.00.00',
                'description' => 'ARRENDAMIENTOS VITRAL', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.12.00.00',
                'description' => 'ARRENDAMIENTOS CASCADA', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.1.03.02.13.00.00',
                'description' => 'ARRENDAMIENTOS ESPACIOS . VOLUMETRICOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.2.00.00.00.00.00',
                'description' => 'OTROS INGRESOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.2.01.00.00.00.00',
                'description' => 'INGRESOS EXTRAORDINARIOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'5.2.01.01.00.00.00',
                'description' => 'INGRESOS POR DISCONTINUACION', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.2.01.02.00.00.00',
                'description' => 'GANANCIAS DE NO OPERACION', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.2.01.03.00.00.00',
                'description' => 'DIFERENCIAS FACTURACION', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.2.01.04.00.00.00',
                'description' => 'INGRESOS POR IMPUESTO DIFERIDO', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.2.01.05.00.00.00',
                'description' => 'INGRESOS POR EXPORTACIONES', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'5.2.01.06.00.00.00',
                'description' => 'OTROS INGRESOS', 
                'type_account' =>'I', 
                'type_naturaled' =>'A', 
                'group' => 'R' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'6.0.00.00.00.00.00',
                'description' => 'LIQUID. RESULTADOS DEUDORES Y ACREEDORES', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'6.1.00.00.00.00.00',
                'description' => 'CUENTAS DE LIQUIDACION RESULTADOS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'6.1.01.00.00.00.00',
                'description' => 'CUENTAS LIQUIDADORAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'6.1.01.01.00.00.00',
                'description' => 'PERDIDAS Y GANANCIAS', 
                'type_account' =>'A', 
                'type_naturaled' =>'D', 
                'group' =>'B' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'7.0.00.00.00.00.00',
                'description' => 'CUENTAS DE MEMORANDUM DEUDORAS', 
                'type_account' =>'O', 
                'type_naturaled' =>'D', 
                'group' =>'O' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'7.1.00.00.00.00.00',
                'description' => 'CUENTAS DE ORDEN DEUDORAS', 
                'type_account' =>'O', 
                'type_naturaled' =>'D', 
                'group' =>'O' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'7.1.01.00.00.00.00',
                'description' => 'CUENTAS DE ORDEN', 
                'type_account' =>'O', 
                'type_naturaled' =>'D', 
                'group' =>'O' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'7.1.02.00.00.00.00',
                'description' => 'CHEQUES EN GARANTIA', 
                'type_account' =>'O', 
                'type_naturaled' =>'D', 
                'group' =>'O' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'8.0.00.00.00.00.00',
                'description' => 'CUENTAS  DE MEMORANDUM ACREEDO', 
                'type_account' =>'O', 
                'type_naturaled' =>'A', 
                'group' =>'O' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'8.1.00.00.00.00.00',
                'description' => 'CUENTAS DE ORDEN ACREEDORAS', 
                'type_account' =>'O', 
                'type_naturaled' =>'A', 
                'group' =>'O' ,
                'accept_transaction' =>'N'
            ],
            [
                'code' =>'8.1.01.00.00.00.00',
                'description' => 'CONTRAPARTE DE CUENTAS DE ORDEN', 
                'type_account' =>'O', 
                'type_naturaled' =>'A', 
                'group' =>'O' ,
                'accept_transaction' =>'S'
            ],
            [
                'code' =>'8.1.02.00.00.00.00',
                'description' => 'CHEQUES EN GARANTIA', 
                'type_account' =>'O', 
                'type_naturaled' =>'A', 
                'group' =>'O' ,
                'accept_transaction' =>'S'
            ]
        ]);
    }
}