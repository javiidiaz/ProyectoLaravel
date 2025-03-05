<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Rutas de la Aplicación
|--------------------------------------------------------------------------
|
| Aquí se definen todas las rutas de la aplicación. Las rutas están organizadas
| por funcionalidad y se agrupan según su propósito (autenticación, administración, carrito, etc.).
|
*/

// Redirige la raíz '/' a '/home'
Route::get('/', function () {
    return redirect()->route('home');
});

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
|
| Estas rutas manejan el registro, inicio de sesión y cierre de sesión de los usuarios.
|
*/

// Página principal (requiere que el usuario esté autenticado)
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Mostrar formulario de registro (solo para usuarios no autenticados)
Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('register');

// Procesar el registro de usuarios
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Mostrar formulario de login (solo para usuarios no autenticados)
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');

// Procesar el inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Cerrar sesión (requiere que el usuario esté autenticado)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas de Administración
|--------------------------------------------------------------------------
|
| Estas rutas son accesibles solo para usuarios autenticados y permiten gestionar
| productos y pedidos desde el panel de administración.
|
*/

// Ruta para el panel de administración
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth')->name('admin.index');

// Rutas para crear, editar, y eliminar productos
Route::get('/admin/products/create', [AdminController::class, 'create'])->middleware('auth')->name('admin.create');
Route::post('/admin/products', [AdminController::class, 'store'])->middleware('auth')->name('admin.store');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit'])->middleware('auth')->name('admin.edit');
Route::put('/admin/products/{id}', [AdminController::class, 'update'])->middleware('auth')->name('admin.update');
Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->middleware('auth')->name('admin.destroy');

// Ruta para ver todos los pedidos (accesible solo para administradores)
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');

// Ruta para cambiar el estado de un pedido
Route::put('/admin/orders/{order}/update-status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');

/*
|--------------------------------------------------------------------------
| Rutas del Carrito de Compras
|--------------------------------------------------------------------------
|
| Estas rutas permiten a los usuarios gestionar su carrito de compras.
|
*/

// Ver el carrito
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

// Añadir un producto al carrito
Route::post('cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');

// Actualizar la cantidad de un producto en el carrito
Route::put('cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

// Eliminar un producto del carrito
Route::delete('cart/delete/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

// Procesar la compra (checkout)
Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/*
|--------------------------------------------------------------------------
| Rutas de Pedidos
|--------------------------------------------------------------------------
|
| Estas rutas permiten a los usuarios ver sus pedidos.
|
*/

// Ver los pedidos del usuario autenticado
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
