<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7fc;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 40px;
        }
        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #3949AB;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead {
            background-color: #3949AB;
            color: white;
        }
        .table tbody tr {
            background-color: #ffffff;
        }
        .table td {
            padding: 15px;
        }
        .btn-primary {
            background-color: #3949AB;
            border: none;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #5C6BC0;
        }
        .btn-danger {
            background-color: #FF7043;
            border: none;
        }
        .btn-danger:hover {
            background-color: #FF5722;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-lg {
            padding: 10px 30px;
            font-size: 1.2rem;
        }
        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3949AB;
        }
        .alert {
            font-size: 1.1rem;
        }
        .text-end {
            margin-top: 20px;
        }
        .back-to-home {
            margin-top: 20px;
        }
        .back-to-home a {
            background-color: #FF7043;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
        }
        .back-to-home a:hover {
            background-color: #E64A19;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center mb-4">Tu Carrito de Compras</h2>

        <div class="text-center mb-4">
            <a href="{{ route('orders.index') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Ver Pedidos
            </a>
        </div>

        <!-- Verificar si el carrito está vacío -->
        @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $productId => $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ number_format($product['price'], 2) }} €</td>
                    <td>
                        <form action="{{ route('cart.update', $productId) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" class="form-control w-auto d-inline-block">
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Actualizar</button>
                        </form>
                    </td>
                    <td>{{ number_format($product['price'] * $product['quantity'], 2) }} €</td>
                    <td>
                        <form action="{{ route('cart.destroy', $productId) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Mostrar el total del carrito -->
        <div class="text-end total-price">
            <h4>Total: {{ number_format($total, 2) }} €</h4>
        </div>

        <!-- Botón de checkout -->
        <div class="text-center mt-4">
            <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg">Proceder al Pago</a>
        </div>

        @else
        <div class="alert alert-info text-center">
            Tu carrito está vacío.
        </div>
        @endif

        <!-- Botón para volver al home -->
        <div class="back-to-home text-center">
            <a href="{{ route('home') }}" class="btn btn-lg btn-secondary">Volver al Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
