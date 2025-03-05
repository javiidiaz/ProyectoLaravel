<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Añadir un producto al carrito (almacenado en sesión)
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Obtener el carrito de la sesión (si no existe, inicializarlo)
        $cart = session()->get('cart', []);

        // Si el producto ya está en el carrito, aumentar la cantidad
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $cart[$productId]['total_price'] = $cart[$productId]['quantity'] * $product->price;
        } else {
            // Si el producto no está en el carrito, agregarlo
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'total_price' => $product->price,
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // Mostrar el carrito
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'total_price')); // Calcular el total del carrito

        return view('cart.index', compact('cart', 'total'));
    }

    // Actualizar la cantidad de un producto en el carrito
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        // Actualizar la cantidad y el precio total
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            $cart[$productId]['total_price'] = $cart[$productId]['quantity'] * $cart[$productId]['price'];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // Eliminar un producto del carrito
    public function destroy($productId)
    {
        $cart = session()->get('cart', []);

        // Eliminar el producto del carrito
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // Procesar la compra y guardar en la base de datos
    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'total_price'));

        // Crear la orden
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'status' => 'pendiente',
        ]);

        // Crear los items de la orden
        foreach ($cart as $productId => $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['total_price'],
            ]);
        }

        // Vaciar el carrito después de la compra
        session()->forget('cart');

        return redirect()->route('cart.index'); // Redirigir al usuario a sus pedidos
    }
}

