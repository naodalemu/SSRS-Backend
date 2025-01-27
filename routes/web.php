<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuIngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MenuTagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');


Route::get('/401', function () {
    return view('errors.401');
})->name('error.401');

Route::get('/404', function () {
    return view('errors.404');
})->name('error.404');

Route::get('/500', function () {
    return view('errors.500');
})->name('error.500');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});
Route::middleware('auth')->group(function () {
Route::get('/settings/edit', [UserController::class, 'edit'])->name('settings.edit');
Route::post('/settings/update', [UserController::class, 'update'])->name('settings.update');
});
//table route
Route::middleware('auth')->group(function () {
    Route::get('/table', [TableController::class, 'index'])->name('table.index');
    Route::post('/table', [TableController::class, 'store'])->name('table.store');
    Route::get('/table/create', [TableController::class, 'create'])->name('table.create');
    Route::get('/table/{id}/show', [TableController::class, 'show'])->name('table.show');
    Route::get('table/{id}/edit', [TableController::class, 'edit'])->name('table.edit');
    Route::put('table/{table}/update', [TableController::class, 'update'])->name('table.update');
    Route::delete('/table/{id}', [TableController::class, 'destroy'])->name('table.destroy');
});

//category route
Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/catagory/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/category/{category}/show', [categoryController::class, 'show'])->name('category.show');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});


//ingredient route
Route::middleware('auth')->group(function () {
    Route::get('/ingredient', [IngredientController::class, 'index'])->name('ingredient.index');
    Route::post('/ingredient', [IngredientController::class, 'store'])->name('ingredient.store');
    Route::get('/ingredient/create', [IngredientController::class, 'create'])->name('ingredient.create');
    Route::get('/ingredient/{ingredient}', [IngredientController::class, 'show'])->name('ingredient.show');
    Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::get('/ingredient/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');
    Route::delete('/ingredient/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredient.destroy');
});


//menuingredient route
Route::middleware('auth')->group(function () {
    Route::get('/menuingredient', [MenuIngredientController::class, 'index'])->name('menuingredient.index');
    Route::post('/menuingredient', [MenuIngredientController::class, 'store']);
    Route::get('/menuingredient/create', [menuingredientController::class, 'create'])->name('menuingredient.create');
    Route::put('/menuingredient/update/{menuingredientID}', [menuingredientController::class, 'update'])->name('menuingredients.update');
    Route::get('/menuingredient/{menuingredientID}/edit', [menuingredientController::class, 'edit'])->name('menuingredient.edit');
    Route::delete('/menuingredient/{menuingredientID}', [menuingredientController::class, 'destroy'])->name('menuingredient.destroy');
});

//orders route
Route::post('orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
Route::put('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
route::get('/orders', [OrderController::class, 'index'])->name('tables.order.index');
Route::resource('order', OrderController::class);
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::put('/order/update/{orderID}', [OrderController::class, 'update'])->name('order.update');
Route::get('/order/edit/{orderID}', [OrderController::class, 'edit'])->name('order.edit');
Route::delete('/order/delete/{orderID}', [OrderController::class, 'destroy'])->name('order.delete');
Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');

//menuitems
Route::middleware('auth')->group(function () {
    Route::get('/menuitem', [MenuItemController::class, 'index'])->name('menuitem.index');
    Route::post('/menuitem', [MenuItemController::class, 'store'])->name('menuitem.store');
    Route::get('/menuitem/create', [MenuItemController::class, 'create'])->name('menuitem.create');
    Route::get('/menuitem/{menuItem}', [MenuItemController::class, 'show'])->name('menuitem.show');
    Route::put('/menuitem/{menuItem}', [MenuItemController::class, 'update'])->name('menuitem.update');
    Route::get('/menuitem/{menuItem}/edit', [MenuItemController::class, 'edit'])->name('menuitem.edit');
    Route::delete('/menuitem/{menuItem}', [MenuItemController::class, 'destroy'])->name('menuitem.destroy');
});

//orderitems

// Custom routes for order items with order ID
Route::get('orders/{orderId}/items/create', [OrderItemController::class, 'create'])->name('orderitem.create');
Route::post('orders/{orderId}/items', [OrderItemController::class, 'store'])->name('orderitem.store');

// Route for showing order items
Route::get('orderitems', [OrderItemController::class, 'index'])->name('orderitem.index');

// Routes for editing and updating order items
Route::get('orderitems/{orderitemID}/edit', [OrderItemController::class, 'edit'])->name('orderitem.edit');
Route::put('orderitems/{orderitemID}', [OrderItemController::class, 'update'])->name('orderitem.update');

// Route for deleting order items
Route::delete('orderitems/{orderitemID}', [OrderItemController::class, 'destroy'])->name('orderitem.delete');


//tag route
Route::middleware('auth')->group(function () {
    Route::get('/tag', [TagController::class, 'index'])->name('tag.index');
    Route::post('/tag', [TagController::class, 'store'])->name('tag.store');
    Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::get('/tag/{tag}', [TagController::class, 'show'])->name('tag.show');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::get('/tag/{tag}/edit', [TagController::class, 'edit'])->name('tag.edit');
    Route::delete('/tag/{tag}', [TagController::class, 'destroy'])->name('tag.destroy');
});


//menutags route
Route::middleware('auth')->group(function () {
    Route::get('/menutag', [MenuTagController::class, 'index'])->name('menutags.index');
    Route::post('/menutag', [MenuTagController::class, 'store'])->name('menutags.store');
    Route::get('/menutag/create', [MenuTagController::class, 'create'])->name('menutags.create');
    Route::put('/menutag/update/{menutagId}', [MenuTagController::class, 'update'])->name('menutags.update');
    Route::get('/menutag/edit/{menutagId}', [MenuTagController::class, 'edit'])->name('menutags.edit');
    Route::delete('/menutag/delete/{menutagId}', [MenuTagController::class, 'destroy'])->name('menutags.delete');
});


//image routes
Route::middleware('auth')->group(function () {
    Route::get('/images', [imageController::class, 'index'])->name('images.index');
    Route::get('/createimages', [imageController::class, 'create'])->name('images.create');
    Route::post('/images', [imageController::class, 'store'])->name('images.store');
    Route::get('/images/{imageId}', [ImageController::class, 'show'])->name('images.show');
    Route::get('/images/edit/{imageId}', [ImageController::class, 'edit'])->name('images.edit');
    Route::put('/images/update/{imageId}', [ImageController::class, 'update'])->name('images.update');
    Route::delete('/images/delete/{imageId}', [ImageController::class, 'destroy'])->name('images.delete');
});

//Route::resource('Ingredient','IngredientController');
//Route::resource('MenuIngredient','MenuIngredientController');
//Route::resource('MenuItem','MenuItemController');
//Route::resource('MenuTag','MenuTagController');
Route::resource('OrderItem','OrderItemController');
Route::resource('Order','OrderController');
//Route::resource('Payment','PaymentController');
//Route::resource('Table','TableController');
//Route::resource('Tag','TagController');


