<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Client\TourController;
use App\Http\Controllers\Admin\TourAdminController;
use App\Http\Controllers\Client\HotelController;
use App\Http\Controllers\Admin\HotelAdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Client\RestaurantController;
use App\Http\Controllers\Admin\RestaurantAdminController;
use App\Http\Controllers\Client\CarController;
use App\Http\Controllers\Admin\CarAdminController;
use App\Http\Controllers\Client\BookingController;
use App\Http\Controllers\Admin\BookingAdminController;
//login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'Register'])->name('register');



//client
Route::get("/", [HomeController::class, 'index'])->name('client.home');

//client tour
Route::get('/tour', [TourController::class, 'index'])->name('client.tour');
Route::get('/tour/search', [TourController::class, 'search'])->name('client.tour.search');
Route::get('/tour/{id}', [TourController::class, 'detail'])->name('client.tour.detail');

//client hotel
Route::get('/hotel', [HotelController::class, 'index'])->name('client.hotel');
Route::get('/hotel/search', [HotelController::class, 'search'])->name('client.hotel.search');
Route::get('/hotel/{id}', [HotelController::class, 'detail'])->name('client.hotel.detail');

//client restaurant
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('client.restaurant');
Route::get('/restaurant/{id}', [RestaurantController::class, 'detail'])->name('client.restaurant.detail');

//client car
Route::get('/car', [CarController::class, 'index'])->name('client.car');
Route::get('/car/{id}', [CarController::class, 'detail'])->name('client.car.detail');

//booking
Route::middleware('auth')->group(function () {
    // Route xử lý thêm vào giỏ
    Route::post('/add-to-cart', [BookingController::class, 'addToCart'])->name('cart.add');
    Route::get('/booking/choices', [BookingController::class, 'showChoices'])->name('booking.choices');

    // Route xử lý lưu vào DB
    Route::get('/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::get('/checkout', [BookingController::class, 'showCheckout'])->name('booking.checkout');
    Route::post('/cart/remove/{index}', [BookingController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/confirm-booking', [BookingController::class, 'confirmBooking'])->name('booking.confirm');
});

//admin
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
Route::get('/admin', [AdminHomeController::class, 'adminIndex'])->name('admin');

//menu
Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu');
Route::get('/admin/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menu.store');
Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');

//admin tour
Route::get('/admin/tour', [TourAdminController::class, 'index'])->name('admin.tour');
Route::get('/admin/tour/create', [TourAdminController::class, 'create'])->name('admin.tour.create');
Route::post('/admin/tour', [TourAdminController::class, 'store'])->name('admin.tour.store');
Route::get('/admin/tour/{id}/edit', [TourAdminController::class, 'edit'])->name('admin.tour.edit');
Route::put('/admin/tour/{id}', [TourAdminController::class, 'update'])->name('admin.tour.update');
Route::delete('/admin/tour/{id}', [TourAdminController::class, 'destroy'])->name('admin.tour.destroy');

//admin hotel
Route::get('/admin/hotel', [HotelAdminController::class, 'index'])->name('admin.hotel');
Route::get('/admin/hotel/create', [HotelAdminController::class, 'create'])->name('admin.hotel.create');
Route::post('/admin/hotel', [HotelAdminController::class, 'store'])->name('admin.hotel.store');
Route::get('/admin/hotel/{id}/edit', [HotelAdminController::class, 'edit'])->name('admin.hotel.edit');
Route::put('/admin/hotel/{id}', [HotelAdminController::class, 'update'])->name('admin.hotel.update');
Route::delete('/admin/hotel/{id}', [HotelAdminController::class, 'destroy'])->name('admin.hotel.destroy');

//admin restaurant
Route::get('/admin/restaurant', [RestaurantAdminController::class, 'index'])->name('admin.restaurant');
Route::get('/admin/restaurant/create', [RestaurantAdminController::class, 'create'])->name('admin.restaurant.create');
Route::post('/admin/restaurant', [RestaurantAdminController::class, 'store'])->name('admin.restaurant.store');
Route::get('/admin/restaurant/{id}/edit', [RestaurantAdminController::class, 'edit'])->name('admin.restaurant.edit');
Route::put('/admin/restaurant/{id}', [RestaurantAdminController::class, 'update'])->name('admin.restaurant.update');
Route::delete('/admin/restaurant/{id}', [RestaurantAdminController::class, 'destroy'])->name('admin.restaurant.destroy');

//admin car
Route::get('/admin/car', [CarAdminController::class, 'index'])->name('admin.car');
Route::get('/admin/car/create', [CarAdminController::class, 'create'])->name('admin.car.create');
Route::post('/admin/car', [CarAdminController::class, 'store'])->name('admin.car.store');
Route::get('/admin/car/{id}/edit', [CarAdminController::class, 'edit'])->name('admin.car.edit');
Route::put('/admin/car/{id}', [CarAdminController::class, 'update'])->name('admin.car.update');
Route::delete('/admin/car/{id}', [CarAdminController::class, 'destroy'])->name('admin.car.destroy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/booking', [BookingAdminController::class, 'index'])->name('booking.index');
    Route::get('/booking/{id}', [BookingAdminController::class, 'show'])->name('booking.show');
    Route::delete('/booking/{id}', [BookingAdminController::class, 'destroy'])->name('booking.destroy');
    Route::patch('/booking/{id}/status', [BookingAdminController::class, 'updateStatus'])->name('booking.updateStatus');
});
