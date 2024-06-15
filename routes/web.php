<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, ProdukController, KontakController, ProfileController, Auth\LoginController, 
    Auth\RegisterController, OrderController, AdminController, DashboardController, AdminAuthController, 
    AdminRegisterController, AboutController, CartController, ReviewController
};

// Route untuk halaman home
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Rute untuk menampilkan daftar produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');

// Rute untuk menampilkan detail produk
Route::get('/product/{id}', [ProdukController::class, 'show'])->name('orders');

// Route untuk halaman kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/submit-kontak', [KontakController::class, 'submitKontak'])->name('submit.kontak');
Route::get('/about', [AboutController::class, 'about'])->name('about');

// Route untuk halaman profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/riwayatPesanan', [ProfileController::class, 'riwayatPesanan'])->name('profile.riwayatPesanan');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Route untuk logout
Route::get('/logout', function () {
    request()->session()->invalidate();
    return redirect('/');
})->name('logout');

// Menampilkan form login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Menampilkan form registrasi
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route untuk halaman logout
Route::get('/logout-page', function () {
    return view('logout');
})->name('logout.page');

// Route untuk menangani pesanan
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/success', function () {
    return view('orders.success');
})->name('orders.success');

// Route untuk login admin
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Route untuk registrasi admin
Route::get('admin/register', function () {
    return view('admin.register');
})->name('admin.register');
Route::post('admin/register', [AdminRegisterController::class, 'register'])->name('admin.register.submit');

// Route untuk dashboard admin dengan middleware auth untuk admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showProducts'])->name('admin.dashboard');
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.create_product');
    Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.store_product');
    Route::get('/admin/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.edit_product');
    Route::put('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.update_product');
    Route::delete('/admin/products/{product}/delete', [ProdukController::class, 'destroy'])->name('admin.delete_product');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::get('/admin/dashboard/stats', [DashboardController::class, 'stats'])->name('admin.stats');
    Route::get('/admin/orders/{order}', [AdminController::class, 'orderDetails'])->name('admin.order_details');
    Route::get('/admin/manage-products', [ProdukController::class, 'manage'])->name('admin.manage_products');
    Route::get('/admin/orders/{order}/edit', [AdminController::class, 'editOrder'])->name('admin.orders_edit');
    Route::post('/admin/orders/{order}/confirm', [AdminController::class, 'confirmOrder'])->name('admin.confirmOrder');
});

// Route untuk halaman sukses
Route::get('/sukses', function () {
    return view('sukses');
});

// Route untuk menghapus pesanan
Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');

// Route untuk menampilkan halaman keranjang
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/carts', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart/show/{userId}', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update', [CartController::class, 'updateCart']);
Route::post('/cart/remove', [CartController::class, 'removeProductFromCart']);

// Route untuk menangani pembelian
Route::post('/order/success', [OrderController::class, 'store'])->name('orders.success');
Route::get('/order/success', [OrderController::class, 'success'])->name('orders.success');

// Route untuk membuat dan menyimpan review
Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('review.store');

// Pastikan Anda memiliki route yang sesuai di routes/web.php yang mengarah ke method submitKontak ini:
Route::post('/submit-kontak', [KontakController::class, 'submitKontak'])->name('submit.kontak');

// Route untuk lupa password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');