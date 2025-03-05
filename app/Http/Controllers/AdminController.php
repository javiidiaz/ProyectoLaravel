<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Método para mostrar el panel de administración
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    // Método para mostrar el formulario de creación de producto
    public function create()
    {
        return view('admin.create');
    }

    // Método para guardar un nuevo producto
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        // Subir imagen
        $imagePath = $request->file('image')->store('img_products', 'public');

        // Crear el producto
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => basename($imagePath) // Guardar solo el nombre del archivo
        ]);

        return redirect()->route('admin.index');
    }

    // Método para editar un producto
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // Método para actualizar un producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif'
        ]);

        $product = Product::findOrFail($id);

        // Si hay una nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($product->image) {
                Storage::disk('public')->delete('img_products/' . $product->image);
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('img_products', 'public');
            $product->image = basename($imagePath);
        }

        // Actualizar el resto de los campos
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.index');
    }

    // Método para eliminar un producto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Eliminar la imagen si existe
        if ($product->image) {
            Storage::disk('public')->delete('img_products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.index');
    }

    // Método para mostrar todos los pedidos
    public function orders()
    {
        // Obtener todos los pedidos con sus ítems y usuarios relacionados
        $orders = Order::with('items.product', 'user')->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Order $order)
    {
    // Cambiar el estado del pedido
    $order->status = $order->status === 'pendiente' ? 'confirmado' : 'pendiente';
    $order->save();

    return redirect()->back();
    }
}
