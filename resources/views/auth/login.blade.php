<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #5C6BC0, #3949AB);
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container h3 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #3949AB;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #ccc;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #3949AB;
            box-shadow: 0 0 5px rgba(57, 73, 171, 0.5);
        }

        .btn-primary {
            background: #3949AB;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #5C6BC0;
            transform: scale(1.05);
        }

        .register-link {
            margin-top: 15px;
        }

        .register-link a {
            color: #3949AB;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="d-flex flex-column justify-content-center align-items-center vh-100">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-container">
            <h3>Iniciar Sesión</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>

            <div class="register-link">
                <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
