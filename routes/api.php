<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/menu-items', [MenuItemController::class, 'index']); // Get all menu items
Route::get('/tables', [TableController::class, 'index']); // Get all tables with their status (free/occupied)
Route::post('/orders', [OrderController::class, 'store']); // Place a new order
// Fetch orders by customer_ip and customer_generated_id
Route::get('/orders', [OrderController::class, 'getUserOrders']);
