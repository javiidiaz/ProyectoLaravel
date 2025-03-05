<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .admin-panel {
            max-width: 1200px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            font-weight: bold;
            color: #444;
        }
        .btn-add {
            background-color: #5C6BC0;
            color: #fff;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-add:hover {
            background-color: #3F51B5;
        }
        .table-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            background: #fff;
        }
        .table th {
            background-color: #5C6BC0;
            color: white;
            text-align: center;
            padding: 15px;
        }
        .table td {
            vertical-align: middle;
            text-align: center;
            padding: 15px;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table img {
            border-radius: 8px;
            width: 80px;
            height: 80px;
            object-fit: cover;
            transition: 0.3s;
            display: block;
            margin: auto;
        }
        .table img:hover {
            transform: scale(1.1);
        }
        .btn-action {
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: 0.3s;
            display: block;
            margin: auto;
            width: 100px;
        }
        .btn-edit {
            background-color: #FF9800;
            color: white;
        }
        .btn-edit:hover {
            background-color: #F57C00;
        }
        .btn-delete {
            background-color: #D32F2F;
            color: white;
        }
        .btn-delete:hover {
            background-color: #B71C1C;
        }
        .alert {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home')}}">Tienda 'El Habío'</a>
        <div class="ms-auto d-flex align-items-center">
            <span class="fw-bold me-3">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    {{-- Panel de Administración --}}
    <div class="container">
        <div class="admin-panel">
            <div class="panel-header">
                <h2><i class="fas fa-cogs"></i> Panel de Administración</h2>
                <a href="{{ route('admin.orders') }}" class="btn btn-add"><i class="fa-solid fa-file"></i></i> Ver Pedidos</a>
                <a href="{{ route('admin.create') }}" class="btn btn-add"><i class="fas fa-plus"></i> Añadir Producto</a>
            </div>

            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td><img src="{{ asset('storage/img_products/' . $product->image) }}" alt="Imagen del producto"></td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>{{ $product->description }}</td>
                            <td><span class="text-success fw-bold">{{ number_format($product->price, 2) }} €</span></td>
                            <td>
                                <a href="{{ route('admin.edit', $product->id) }}" class="btn btn-edit btn-action mb-1"><i class="fas fa-edit"></i> Editar</a>

                                <form action="{{ route('admin.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-action" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
