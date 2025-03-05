<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 1rem;
        }
        .badge {
            font-size: 1rem;
        }
        .status-badge {
            font-size: 0.9rem;
            margin-left: 10px;
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

    <div class="container">
        <h2 class="text-primary fw-bold">Todos los Pedidos</h2>

        <?php if ($orders->isEmpty()): ?>
            <p class="text-center mt-4">No hay pedidos realizados.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            Pedido #<?php echo $order->id; ?>
                            <!-- Aviso del estado del pedido -->
                            <?php if ($order->status === 'pendiente'): ?>
                                <span class="badge bg-warning status-badge">Pendiente</span>
                            <?php elseif ($order->status === 'confirmado'): ?>
                                <span class="badge bg-success status-badge">Confirmado</span>
                            <?php endif; ?>
                        </h5>
                        <p class="card-text"><strong>Usuario:</strong> <?php echo $order->user->name; ?></p>
                        <p class="card-text"><strong>Fecha:</strong> <?php echo $order->created_at->format('d/m/Y H:i'); ?></p>
                        <p class="card-text"><strong>Total:</strong> <?php echo number_format($order->total_price, 2); ?> €</p>

                        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#pedido<?php echo $order->id; ?>">
                            Ver Detalles
                        </button>

                        <!-- Botón para cambiar el estado del pedido -->
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm <?php echo $order->status === 'pendiente' ? 'btn-success' : 'btn-warning'; ?>">
                                <?php echo $order->status === 'pendiente' ? 'Confirmar Pedido' : 'Marcar como Pendiente'; ?>
                            </button>
                        </form>

                        <div class="collapse mt-3" id="pedido<?php echo $order->id; ?>">
                            <h6>Artículos en este pedido:</h6>
                            <ul class="list-group">
                                <?php foreach ($order->items as $item): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo $item->product->name; ?> (x<?php echo $item->quantity; ?>)
                                        <span class="badge bg-primary rounded-pill">
                                            <?php echo number_format($item->price, 2); ?> €
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades como el colapso) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
