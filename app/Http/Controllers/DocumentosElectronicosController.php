<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentosElectronicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Simulamos datos de documentos electrónicos
        $documentos = [
            [
                'id' => 1,
                'tipo' => 'Factura Electrónica',
                'numero' => 'FE-2024-001',
                'cliente' => 'Empresa ABC S.A. de C.V.',
                'fecha_emision' => '2024-10-20',
                'monto' => 15800.00,
                'estado' => 'Timbrado',
                'uuid' => 'A1B2C3D4-E5F6-7890-ABCD-EF1234567890',
                'fecha_timbrado' => '2024-10-20 10:30:00',
                'pac' => 'PAC Autorizado SA',
                'xml_url' => '#',
                'pdf_url' => '#'
            ],
            [
                'id' => 2,
                'tipo' => 'Nota de Crédito',
                'numero' => 'NC-2024-001',
                'cliente' => 'Comercial XYZ Ltda.',
                'fecha_emision' => '2024-10-19',
                'monto' => 2350.00,
                'estado' => 'Cancelado',
                'uuid' => 'B2C3D4E5-F6G7-8901-BCDE-F23456789012',
                'fecha_timbrado' => '2024-10-19 14:15:00',
                'pac' => 'PAC Autorizado SA',
                'xml_url' => '#',
                'pdf_url' => '#'
            ],
            [
                'id' => 3,
                'tipo' => 'Factura Electrónica',
                'numero' => 'FE-2024-002',
                'cliente' => 'Servicios Profesionales MNO',
                'fecha_emision' => '2024-10-21',
                'monto' => 8750.00,
                'estado' => 'Pendiente',
                'uuid' => null,
                'fecha_timbrado' => null,
                'pac' => 'PAC Autorizado SA',
                'xml_url' => null,
                'pdf_url' => null
            ],
            [
                'id' => 4,
                'tipo' => 'Carta Porte',
                'numero' => 'CP-2024-001',
                'cliente' => 'Transportes DEF S.A.',
                'fecha_emision' => '2024-10-18',
                'monto' => 4200.00,
                'estado' => 'Timbrado',
                'uuid' => 'C3D4E5F6-G7H8-9012-CDEF-345678901234',
                'fecha_timbrado' => '2024-10-18 09:45:00',
                'pac' => 'PAC Autorizado SA',
                'xml_url' => '#',
                'pdf_url' => '#'
            ],
            [
                'id' => 5,
                'tipo' => 'Recibo de Honorarios',
                'numero' => 'RH-2024-001',
                'cliente' => 'Consultoría GHI',
                'fecha_emision' => '2024-10-22',
                'monto' => 12000.00,
                'estado' => 'Rechazado',
                'uuid' => null,
                'fecha_timbrado' => null,
                'pac' => 'PAC Autorizado SA',
                'xml_url' => null,
                'pdf_url' => null
            ]
        ];

        $estadisticas = [
            'total_mes' => 42800.00,
            'documentos_timbrados' => 3,
            'documentos_pendientes' => 1,
            'documentos_cancelados' => 1,
            'documentos_rechazados' => 1,
            'porcentaje_exitosos' => 75
        ];

        $configuracion_pac = [
            'pac_nombre' => 'PAC Autorizado SA',
            'pac_rfc' => 'PAC123456789',
            'certificado_vigencia' => '2025-12-31',
            'timbres_disponibles' => 850,
            'timbres_utilizados' => 150,
            'estado_conexion' => 'Activo'
        ];

        return view('documentos-electronicos.index', compact('documentos', 'estadisticas', 'configuracion_pac'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos_documento = [
            'factura' => 'Factura Electrónica',
            'nota_credito' => 'Nota de Crédito',
            'nota_debito' => 'Nota de Débito',
            'carta_porte' => 'Carta Porte',
            'recibo_honorarios' => 'Recibo de Honorarios',
            'recibo_arrendamiento' => 'Recibo de Arrendamiento'
        ];

        $clientes = [
            ['id' => 1, 'nombre' => 'Empresa ABC S.A. de C.V.', 'rfc' => 'ABC123456789'],
            ['id' => 2, 'nombre' => 'Comercial XYZ Ltda.', 'rfc' => 'XYZ987654321'],
            ['id' => 3, 'nombre' => 'Servicios Profesionales MNO', 'rfc' => 'MNO456789123'],
            ['id' => 4, 'nombre' => 'Transportes DEF S.A.', 'rfc' => 'DEF789123456'],
            ['id' => 5, 'nombre' => 'Consultoría GHI', 'rfc' => 'GHI321654987']
        ];

        return view('documentos-electronicos.create', compact('tipos_documento', 'clientes'));
    }

        /**
     * Store a newly created client via AJAX.
     */
    public function clientesStoreAjax(Request $request)
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

        // Simular la creación del cliente (en producción se guardaria en la base de datos)
        $nuevoCliente = [
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
            'message' => 'Cliente creado exitosamente',
            'cliente' => $nuevoCliente
        ]);
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        // Aquí se implementaría la lógica para crear y timbrar el documento
        return redirect()->route('documentos-electronicos.index')
                        ->with('success', 'Documento electrónico creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Simular datos del documento específico
        $documento = [
            'id' => $id,
            'tipo' => 'Factura Electrónica',
            'numero' => 'FE-2024-001',
            'serie' => 'A',
            'folio' => '001',
            'cliente' => [
                'nombre' => 'Empresa ABC S.A. de C.V.',
                'rfc' => 'ABC123456789',
                'direccion' => 'Av. Principal 123, Col. Centro',
                'email' => 'contacto@empresaabc.com'
            ],
            'fecha_emision' => '2024-10-20',
            'fecha_timbrado' => '2024-10-20 10:30:00',
            'monto' => 15800.00,
            'subtotal' => 13620.69,
            'iva' => 2179.31,
            'total' => 15800.00,
            'estado' => 'Timbrado',
            'uuid' => 'A1B2C3D4-E5F6-7890-ABCD-EF1234567890',
            'pac' => 'PAC Autorizado SA',
            'cadena_original' => '||1.1|A1B2C3D4-E5F6-7890-ABCD-EF1234567890|2024-10-20T10:30:00|PAC123456789|15800.00||',
            'sello_digital' => 'ABC123...XYZ789',
            'sello_sat' => 'DEF456...UVW012',
            'xml_url' => '#',
            'pdf_url' => '#',
            'conceptos' => [
                [
                    'cantidad' => 1,
                    'descripcion' => 'Servicio de Consultoría Empresarial',
                    'precio_unitario' => 10000.00,
                    'importe' => 10000.00
                ],
                [
                    'cantidad' => 2,
                    'descripcion' => 'Capacitación Especializada',
                    'precio_unitario' => 1810.34,
                    'importe' => 3620.69
                ]
            ]
        ];

        return view('documentos-electronicos.show', compact('documento'));
    }

    /**
     * Timbrar documento
     */
    public function timbrar($id)
    {
        // Aquí se implementaría la lógica de timbrado con el PAC
        return redirect()->back()->with('success', 'Documento timbrado exitosamente.');
    }

    /**
     * Cancelar documento
     */
    public function cancelar($id)
    {
        // Aquí se implementaría la lógica de cancelación
        return redirect()->back()->with('success', 'Documento cancelado exitosamente.');
    }

    /**
     * Descargar XML
     */
    public function descargarXml($id)
    {
        // Aquí se implementaría la descarga del archivo XML
        return response()->download(storage_path('app/xml/documento_' . $id . '.xml'));
    }

    /**
     * Descargar PDF
     */
    public function descargarPdf($id)
    {
        // Aquí se implementaría la generación y descarga del PDF
        return response()->download(storage_path('app/pdf/documento_' . $id . '.pdf'));
    }

    /**
     * Configuración PAC
     */
    public function configuracion()
    {
        $configuracion = [
            'pac_nombre' => 'PAC Autorizado SA',
            'pac_rfc' => 'PAC123456789',
            'pac_url' => 'https://pac.ejemplo.com',
            'usuario' => 'usuario_pac',
            'certificado_vigencia' => '2025-12-31',
            'timbres_contratados' => 1000,
            'timbres_utilizados' => 150,
            'timbres_disponibles' => 850,
            'estado_conexion' => 'Activo',
            'ultima_sincronizacion' => '2024-10-25 08:30:00'
        ];

        return view('documentos-electronicos.configuracion', compact('configuracion'));
    }

    // ========== MÉTODOS PARA GESTIÓN DE CLIENTES ==========

    /**
     * Mostrar lista de clientes
     */
    public function clientesIndex()
    {
        // Datos simulados de clientes
        $clientes = [
            [
                'id' => 1,
                'tipo_documento' => 'NIT',
                'numero_documento' => '1234567890123',
                'dui' => '12345678-9',
                'razon_social' => 'Empresa ABC S.A. de C.V.',
                'nombre_comercial' => 'ABC Comercial',
                'telefono' => '2234-5678',
                'email' => 'facturacion@empresaabc.com',
                'direccion' => 'Col. San Benito, Av. La Revolución, San Salvador',
                'departamento' => 'San Salvador',
                'municipio' => 'San Salvador',
                'distrito' => 'Centro',
                'giro_comercial' => 'Venta de productos farmacéuticos',
                'estado' => 'Activo',
                'fecha_registro' => '2024-01-15',
                'credito_limite' => 50000.00,
                'credito_utilizado' => 12500.00
            ],
            [
                'id' => 2,
                'tipo_documento' => 'NIT',
                'numero_documento' => '9876543210987',
                'dui' => '98765432-1',
                'razon_social' => 'Comercial XYZ Ltda.',
                'nombre_comercial' => 'XYZ Store',
                'telefono' => '2345-6789',
                'email' => 'ventas@comercialxyz.com',
                'direccion' => 'Col. Escalón, 89 Av. Norte, San Salvador',
                'departamento' => 'San Salvador',
                'municipio' => 'San Salvador',
                'distrito' => 'Escalón',
                'giro_comercial' => 'Comercio al por menor',
                'estado' => 'Activo',
                'fecha_registro' => '2024-02-20',
                'credito_limite' => 30000.00,
                'credito_utilizado' => 8750.00
            ],
            [
                'id' => 3,
                'tipo_documento' => 'DUI',
                'numero_documento' => '11223344-5',
                'dui' => '11223344-5',
                'razon_social' => 'José Manuel Pérez',
                'nombre_comercial' => 'Servicios JMP',
                'telefono' => '7890-1234',
                'email' => 'jm.perez@gmail.com',
                'direccion' => 'Col. Miramonte, Calle Los Cedros #25, Santa Tecla',
                'departamento' => 'La Libertad',
                'municipio' => 'Santa Tecla',
                'distrito' => 'Centro',
                'giro_comercial' => 'Servicios profesionales de consultoría',
                'estado' => 'Activo',
                'fecha_registro' => '2024-03-10',
                'credito_limite' => 15000.00,
                'credito_utilizado' => 0.00
            ]
        ];

        return view('documentos-electronicos.clientes.index', compact('clientes'));
    }

    /**
     * Mostrar formulario para crear cliente
     */
    public function clientesCreate()
    {
        return view('documentos-electronicos.clientes.create');
    }

    /**
     * Guardar nuevo cliente
     */
    public function clientesStore(Request $request)
    {
        // Validación básica
        $request->validate([
            'tipo_documento' => 'required|in:NIT,DUI',
            'numero_documento' => 'required|string|max:20',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'required|string|max:500',
            'departamento' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'giro_comercial' => 'required|string|max:255'
        ]);

        // Aquí normalmente guardarías en la base de datos
        // Cliente::create($request->all());

        return redirect()->route('documentos-electronicos.clientes.index')
                        ->with('success', 'Cliente registrado exitosamente');
    }

    /**
     * Mostrar detalles de un cliente
     */
    public function clientesShow($id)
    {
        // Datos simulados del cliente
        $cliente = [
            'id' => $id,
            'tipo_documento' => 'NIT',
            'numero_documento' => '1234567890123',
            'dui' => '12345678-9',
            'razon_social' => 'Empresa ABC S.A. de C.V.',
            'nombre_comercial' => 'ABC Comercial',
            'telefono' => '2234-5678',
            'email' => 'facturacion@empresaabc.com',
            'direccion' => 'Col. San Benito, Av. La Revolución, San Salvador',
            'departamento' => 'San Salvador',
            'municipio' => 'San Salvador',
            'distrito' => 'Centro',
            'giro_comercial' => 'Venta de productos farmacéuticos',
            'estado' => 'Activo',
            'fecha_registro' => '2024-01-15',
            'credito_limite' => 50000.00,
            'credito_utilizado' => 12500.00
        ];

        // Historial de facturas (simulado)
        $facturas = [
            [
                'numero' => 'FE-2024-001',
                'fecha' => '2024-10-20',
                'monto' => 5800.00,
                'estado' => 'Pagada'
            ],
            [
                'numero' => 'FE-2024-010',
                'fecha' => '2024-10-15',
                'monto' => 3200.00,
                'estado' => 'Pendiente'
            ]
        ];

        return view('documentos-electronicos.clientes.show', compact('cliente', 'facturas'));
    }

    /**
     * Mostrar formulario para editar cliente
     */
    public function clientesEdit($id)
    {
        // Datos simulados del cliente
        $cliente = [
            'id' => $id,
            'tipo_documento' => 'NIT',
            'numero_documento' => '1234567890123',
            'dui' => '12345678-9',
            'razon_social' => 'Empresa ABC S.A. de C.V.',
            'nombre_comercial' => 'ABC Comercial',
            'telefono' => '2234-5678',
            'email' => 'facturacion@empresaabc.com',
            'direccion' => 'Col. San Benito, Av. La Revolución, San Salvador',
            'departamento' => 'San Salvador',
            'municipio' => 'San Salvador',
            'distrito' => 'Centro',
            'giro_comercial' => 'Venta de productos farmacéuticos',
            'credito_limite' => 50000.00
        ];

        return view('documentos-electronicos.clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente
     */
    public function clientesUpdate(Request $request, $id)
    {
        // Validación básica
        $request->validate([
            'tipo_documento' => 'required|in:NIT,DUI',
            'numero_documento' => 'required|string|max:20',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'required|string|max:500',
            'departamento' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'giro_comercial' => 'required|string|max:255'
        ]);

        // Aquí normalmente actualizarías en la base de datos
        // $cliente = Cliente::findOrFail($id);
        // $cliente->update($request->all());

        return redirect()->route('documentos-electronicos.clientes.index')
                        ->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Eliminar cliente
     */
    public function clientesDestroy($id)
    {
        // Aquí normalmente eliminarías de la base de datos
        // $cliente = Cliente::findOrFail($id);
        // $cliente->delete();

        return redirect()->route('documentos-electronicos.clientes.index')
                        ->with('success', 'Cliente eliminado exitosamente');
    }

    /**
     * Buscar clientes (para AJAX)
     */
    public function clientesBuscar($term)
    {
        // Datos simulados de búsqueda
        $clientes = [
            [
                'id' => 1,
                'numero_documento' => '1234567890123',
                'razon_social' => 'Empresa ABC S.A. de C.V.',
                'telefono' => '2234-5678',
                'email' => 'facturacion@empresaabc.com'
            ],
            [
                'id' => 2,
                'numero_documento' => '9876543210987',
                'razon_social' => 'Comercial XYZ Ltda.',
                'telefono' => '2345-6789',
                'email' => 'ventas@comercialxyz.com'
            ]
        ];

        // Filtrar clientes que coincidan con el término de búsqueda
        $resultados = array_filter($clientes, function($cliente) use ($term) {
            return strpos(strtolower($cliente['razon_social']), strtolower($term)) !== false ||
                   strpos($cliente['numero_documento'], $term) !== false;
        });

        return response()->json(array_values($resultados));
    }
}