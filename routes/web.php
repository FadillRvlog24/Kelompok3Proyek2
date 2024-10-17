<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductDisplayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;



Route::get('/', function () {
    return view('welcome');
    
});


Auth::routes();
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/pesanan', [OrderController::class, 'index'])->name('admin.pesanan');
});

Route::get('/admin/register', [AdminRegisterController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminRegisterController::class, 'register']);
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
// Beranda admin setelah login berhasil
Route::get('/admin/beranda', [AdminController::class, 'beranda'])->name('admin.beranda')->middleware('auth:admin');
Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    return redirect('/admin/login');
})->name('admin.logout');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

// Rute untuk admin melihat semua pesanan
Route::get('/admin/pesanan', [OrderController::class, 'showAllOrders'])->name('admin.pesanan');

// Rute untuk memperbarui status pesanan
// Route::post('/admin/pesanan/{id}/update-status', [OrderController::class, 'updateOrderStatus'])->name('admin.updateStatus');

// Rute untuk melihat detail pesanan
Route::get('/admin/pesanan/{id}/detail', [OrderController::class, 'showOrderDetail'])->name('admin.orderDetail');

// Rute untuk menghapus pesanan
Route::delete('/admin/pesanan/{id}/delete', [OrderController::class, 'deleteOrder'])->name('admin.deleteOrder');


Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
Route::get('/admin/pesanan/bukti/{id}', [OrderController::class, 'showBuktiPembayaran'])->name('admin.showBuktiPembayaran');
Route::put('/admin/pesanan/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.updateStatus');


Route::put('/pesanan/{id}', [OrderController::class, 'update'])->name('pesanan.update');


Route::get('/myorders', [OrderController::class, 'index'])->name('myorder');
Route::get('/pesanan-saya', [PesananController::class, 'index'])->name('pesanan.index');


// Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.show');
// Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// // Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
// Route::get('/checkout/success', function () {
//     return view('checkout.success'); // Ganti dengan view yang sesuai
// })->name('checkout.success');

// Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
// Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', function () {
    return view('checkout_success'); // Pastikan nama view sesuai
})->name('checkout.success');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');



Route::get('/product', [ProductDisplayController::class, 'index'])->name('product.index');

// Rute untuk menampilkan detail produk berdasarkan ID
Route::get('/product/{id}', [ProductDisplayController::class, 'show'])->name('product.show');

// Route::get('/produk-detail', [ProductDisplayController::class, 'showSpecific'])->name('product.showSpecific');


// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
// Route::get('/cart', [CartController::class, 'index'])->name('cart');


// Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');


// Route::get('/cart', function () {
//     $cart = Session::get('cart', []);
//     return view('cart', compact('cart'));
// })->name('cart.view');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Route for edit
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Route for delete
});

// Route::get('product/{slug}', function ($slug) {
//     return view('layouts.product', ['product' => $slug]);
// });





// Rute untuk menampilkan profil pengguna
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// Rute untuk menampilkan halaman edit profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Rute untuk memperbarui profil pengguna
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


// Route::match(['get', 'post'], '/produk', [ProductController::class, 'index'])->name('produk.index');

// Route::resource('produk', ProductController::class);

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');

Route::match(['get', 'post'], '/produk', [ProductController::class, 'index'])->name('produk.index');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');


Route::get('/table', function () {
    return view('layouts.table');
});

Route::get('/beranda', function () {
    return view('layouts.beranda');
});

Route::get('/footer', function () {
    return view('layouts.footer');
});


Route::get('/belanja', function () {
    return view('layouts.belanja');
});

Route::get('/tentangkami', function () {
    return view('layouts.tentangkami');
});


Route::get('/lokasi', function () {
    return view('layouts.lokasi');
});

Route::get('/produkdetail', function () {
    return view('layouts.produkdetail');
});



