<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Si se recibe un término de búsqueda, filtramos los productos
        $search = $request->get('search');
        if ($search) {
            $productos = Product::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $productos = Product::all();
        }

        return view('home', compact('productos'));
    }
}
