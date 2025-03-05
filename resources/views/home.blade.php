<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 22px;
            color: #3949AB !important;
        }
        .btn-logout {
            background: #E64A19;
            color: white;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-logout:hover {
            background: #d84315;
        }
        /* Hero Section */
        .hero {
            background: linear-gradient(to right, #5C6BC0, #3949AB);
            color: white;
            text-align: center;
            padding: 50px 20px;
        }
        .hero h1 {
            font-weight: 700;
        }
        /* Productos */
        .products-container {
            margin-top: 40px;
        }
        .product-card {
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
            background: white;
            padding: 15px;
            text-align: center;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            width: 100%;
            height: auto;
            max-height: 250px;
            object-fit: contain;
            border-radius: 10px;
            background: #f8f9fa;
            padding: 10px;
        }
        .product-card h5 {
            font-weight: bold;
            margin-top: 10px;
        }
        .product-card .card-text {
            font-size: 18px;
            font-weight: 600;
            color: #3949AB;
        }
        .btn-primary {
            background: #FF7043;
            border: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
            width: 100%;
        }
        .btn-primary:hover {
            background: #E64A19;
        }
        /* Panel de administración */
        .admin-panel {
            text-align: center;
            margin-top: 20px;
        }
        .admin-panel a {
            background: #FFC107;
            color: #333;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .admin-panel a:hover {
            background: #ffb300;
        }
        /* Estilo para el icono del carrito fijo */
        .cart-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #FF7043;
            border-radius: 50%;
            padding: 15px;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 100;
        }
        .cart-icon:hover {
            background-color: #E64A19;
        }
        .cart-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #fff;
            color: #E64A19;
            font-size: 0.8rem;
            border-radius: 50%;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#"><i class="fas fa-store"></i> Tienda 'El Habío'</a>
        <div class="ms-auto d-flex align-items-center">
            <span class="fw-bold me-3"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Bienvenido a Tienda 'El Habío'</h1>
        <p>Explora nuestros productos y encuentra lo que necesitas</p>
    </div>

    <div class="container products-container">
        <!-- Panel Admin (Solo si el usuario es admin) -->
        @if(Auth::user()->role == 'admin')
            <div class="admin-panel mb-4">
                <a href="{{ route('admin.index') }}" class="btn btn-warning"><i class="fas fa-cogs"></i> Panel Administrador</a>
            </div>
        @endif

        <div class="products-header d-flex justify-content-between">
            <h3 class="text-center text-primary fw-bold mb-5">Nuestros Productos</h3>

            <!-- Formulario de búsqueda -->
            <form action="{{ route('home') }}" method="GET" class="mb-4 d-flex justify-content-end">
                <input type="text" name="search" class="form-control w-100" placeholder="Buscar productos..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary ms-2 w-25"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4">
                    <div class="card product-card mb-4">
                        <img src="{{ asset('storage/img_products/' . $producto->image) }}" class="card-img-top" alt="{{ $producto->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                            <p class="card-subtext text-gray-300">{{ $producto->description }}</p>
                            <p class="card-text">{{ number_format($producto->price, 2) }} €</p>
                            <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-cart-plus"></i> Añadir al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Icono de la cesta con número de productos -->
    <a href="{{ route('cart.index') }}" class="cart-icon">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="badge">{{ count(session('cart', [])) }}</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
