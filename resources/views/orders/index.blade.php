<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
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
        .btn-home {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container p-4">
        <!-- Botón para volver al home -->
        <a href="{{ url('/') }}" class="btn btn-primary btn-home mb-4">Volver al Home</a>

        <h2 class="text-primary fw-bold mb-4">Mis Pedidos</h2>

        <?php if ($orders->isEmpty()): ?>
            <p class="text-center mt-4">No tienes pedidos realizados.</p>
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
                        <p class="card-text"><strong>Fecha:</strong> <?php echo $order->created_at->format('d/m/Y H:i'); ?></p>
                        <p class="card-text"><strong>Total:</strong> <?php echo number_format($order->total_price, 2); ?> €</p>

                        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#pedido<?php echo $order->id; ?>">
                            Ver Detalles
                        </button>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
