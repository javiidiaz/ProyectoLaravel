<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Obtener todos los pedidos del usuario autenticado con sus items y productos relacionados
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->get();

        return view('orders.index', compact('orders'));
    }
}
