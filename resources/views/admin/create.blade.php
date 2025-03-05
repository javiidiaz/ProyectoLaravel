<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-weight: bold;
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
            margin-top: 10px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #5C6BC0;
            box-shadow: 0 0 8px rgba(92, 107, 192, 0.2);
        }
        .btn-submit {
            background-color: #5C6BC0;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            width: 100%;
        }
        .btn-submit:hover {
            background-color: #3F51B5;
        }
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #5C6BC0;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-back:hover {
            color: #3F51B5;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2><i class="fas fa-box-open"></i> Añadir Nuevo Producto</h2>

            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name"><i class="fas fa-tag"></i> Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Descripción</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price"><i class="fas fa-euro-sign"></i> Precio</label>
                    <input type="number" name="price" step="any" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image"><i class="fas fa-image"></i> Imagen</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-submit mt-4"><i class="fas fa-save"></i> Guardar Producto</button>
            </form>

            <a href="{{ route('admin.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver al Panel</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
