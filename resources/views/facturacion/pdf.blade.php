<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura {{ $facturaCompleta['numero'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        
        .logo-section {
            flex: 1;
        }
        
        .invoice-info {
            flex: 1;
            text-align: right;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }
        
        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .client-info, .company-info {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            margin: 0 10px;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 14px;
            color: #007bff;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .details-table th {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        
        .details-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .totals-section {
            margin-top: 30px;
            float: right;
            width: 300px;
        }
        
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .totals-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        
        .total-final {
            font-weight: bold;
            font-size: 16px;
            background-color: #f8f9fa;
        }
        
        .footer {
            clear: both;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pagada {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-vencida {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            
            .no-print {
                display: none;
            }
        }
        
        .print-actions {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .btn-secondary {
            background-color: #6c757d;
        }
        
        .btn-secondary:hover {
            background-color: #545b62;
        }
    </style>
</head>
<body>
    <!-- Acciones de impresión -->
    <div class="print-actions no-print">
        <button class="btn" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimir
        </button>
        <a href="{{ route('facturacion.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

    <!-- Encabezado -->
    <div class="header">
        <div class="logo-section">
            <div class="company-name">{{ $facturaCompleta['empresa']['nombre'] }}</div>
            <div>RFC: {{ $facturaCompleta['empresa']['rfc'] }}</div>
            <div>{{ $facturaCompleta['empresa']['direccion'] }}</div>
            <div>Tel: {{ $facturaCompleta['empresa']['telefono'] }}</div>
            <div>Email: {{ $facturaCompleta['empresa']['email'] }}</div>
        </div>
        <div class="invoice-info">
            <div class="invoice-title">FACTURA</div>
            <div><strong>No. {{ $facturaCompleta['numero'] }}</strong></div>
            <div>Fecha: {{ \Carbon\Carbon::parse($facturaCompleta['fecha'])->format('d/m/Y') }}</div>
            <div>Vencimiento: {{ \Carbon\Carbon::parse($facturaCompleta['fecha_vencimiento'])->format('d/m/Y') }}</div>
            <div style="margin-top: 10px;">
                <span class="status-badge status-{{ strtolower($facturaCompleta['estado']) === 'pagada' ? 'pagada' : (strtolower($facturaCompleta['estado']) === 'pendiente' ? 'pendiente' : 'vencida') }}">
                    {{ $facturaCompleta['estado'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- Información del cliente y empresa -->
    <div class="info-section">
        <div class="client-info">
            <div class="section-title">FACTURAR A:</div>
            <div><strong>{{ $facturaCompleta['cliente']['nombre'] }}</strong></div>
            <div>RFC: {{ $facturaCompleta['cliente']['rfc'] }}</div>
            <div>{{ $facturaCompleta['cliente']['direccion'] }}</div>
            <div>Tel: {{ $facturaCompleta['cliente']['telefono'] }}</div>
            <div>Email: {{ $facturaCompleta['cliente']['email'] }}</div>
        </div>
        <div class="company-info">
            <div class="section-title">EXPEDIDO POR:</div>
            <div><strong>{{ $facturaCompleta['empresa']['nombre'] }}</strong></div>
            <div>RFC: {{ $facturaCompleta['empresa']['rfc'] }}</div>
            <div>{{ $facturaCompleta['empresa']['direccion'] }}</div>
            <div>Tel: {{ $facturaCompleta['empresa']['telefono'] }}</div>
            <div>Email: {{ $facturaCompleta['empresa']['email'] }}</div>
        </div>
    </div>

    <!-- Detalles de la factura -->
    <table class="details-table">
        <thead>
            <tr>
                <th width="10%">Cantidad</th>
                <th width="50%">Descripción</th>
                <th width="20%">Precio Unitario</th>
                <th width="20%">Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturaCompleta['conceptos'] as $concepto)
            <tr>
                <td class="text-center">{{ number_format($concepto['cantidad'], 0) }}</td>
                <td>{{ $concepto['descripcion'] }}</td>
                <td class="text-right">${{ number_format($concepto['precio_unitario'], 2) }}</td>
                <td class="text-right">${{ number_format($concepto['importe'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totales -->
    <div class="totals-section">
        <table class="totals-table">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">${{ number_format($facturaCompleta['subtotal'], 2) }}</td>
            </tr>
            <tr>
                <td>IVA (13%):</td>
                <td class="text-right">${{ number_format($facturaCompleta['iva'], 2) }}</td>
            </tr>
            <tr class="total-final">
                <td><strong>TOTAL:</strong></td>
                <td class="text-right"><strong>${{ number_format($facturaCompleta['total'], 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- Información adicional -->
    <div class="footer">
        <div style="margin-bottom: 20px;">
            <strong>Forma de Pago:</strong> Transferencia Electrónica | 
            <strong>Método de Pago:</strong> PUE - Pago en una sola exhibición
        </div>
        
        <div style="margin-bottom: 20px;">
            <strong>Condiciones de Pago:</strong> 30 días a partir de la fecha de facturación
        </div>
        
        <div style="font-size: 10px; color: #888;">
            <p>Esta factura fue generada electrónicamente y es válida sin firma autógrafa.</p>
            <p>Para cualquier aclaración sobre esta factura, favor de contactar a nuestro departamento de cobranza.</p>
            <p style="margin-top: 15px;">
                <strong>{{ $facturaCompleta['empresa']['nombre'] }}</strong> | 
                {{ $facturaCompleta['empresa']['telefono'] }} | 
                {{ $facturaCompleta['empresa']['email'] }}
            </p>
        </div>
    </div>

    <script>
        // Auto-focus para impresión inmediata si se desea
        // window.onload = function() { window.print(); }
        
        // Función para imprimir
        function imprimirFactura() {
            window.print();
        }
    </script>
</body>
</html>