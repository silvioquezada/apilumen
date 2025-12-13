<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
    </style>
</head>
<body>
    <h1>Reporte de productos</h1>

    <ul>
        @foreach ($productos as $producto)
            <li>{{ $producto['descripcion'] }} — {{ $producto['precio'] }}</li>
        @endforeach
    </ul>
</body>
</html>
