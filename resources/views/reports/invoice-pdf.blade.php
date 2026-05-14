<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #333; margin-bottom: 5px; }
        h3 { text-align: center; color: #666; margin-top: 0; font-weight: normal; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .entry { color: #16a34a; font-weight: bold; }
        .exit { color: #dc2626; font-weight: bold; }
        .summary { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .summary p { margin: 5px 0; }
        .footer { text-align: center; margin-top: 30px; color: #999; font-size: 10px; }
    </style>
</head>
<body>
    <h1>Reporte de Inventario</h1>
    <h3>{{ $label }}</h3>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Usuario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movements as $mov)
            <tr>
                <td>{{ $mov->product->name }}</td>
                <td class="{{ $mov->type === 'entry' ? 'entry' : 'exit' }}">
                    {{ $mov->type === 'entry' ? 'INGRESO' : 'EGRESO' }}
                </td>
                <td>{{ $mov->quantity }}</td>
                <td>{{ $mov->user->name }}</td>
                <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center">No hay movimientos en este periodo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total de Ingresos:</strong> {{ $totalEntries }}</p>
        <p><strong>Total de Egresos:</strong> {{ $totalExits }}</p>
        <p><strong>Movimientos Registrados:</strong> {{ $movements->count() }}</p>
        <p><strong>Fecha de generación:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="footer">
        Sistema de Gestión de Inventario - Generado el {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
