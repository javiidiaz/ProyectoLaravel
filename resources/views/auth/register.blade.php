<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #5C6BC0, #3949AB);
            font-family: 'Poppins', sans-serif;
        }

        .register-container {
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .register-container h3 {
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

        .login-link {
            margin-top: 15px;
        }

        .login-link a {
            color: #3949AB;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
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

        <div class="register-container">
            <h3>Registro</h3>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirmar Contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>

            <div class="login-link">
                <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
