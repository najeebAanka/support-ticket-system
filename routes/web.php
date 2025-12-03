<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware('auth.admin')->prefix('admin')->group(function () {
    
    Route::get('/tickets', [AdminTicketController::class, 'index'])
          ->name('admin.tickets.index');

    Route::get('/tickets/{ticket}/{dept}', [AdminTicketController::class, 'show'])
          ->name('admin.tickets.show');

    Route::post('/tickets/{ticket}/{dept}/note', [AdminTicketController::class, 'addNote'])
          ->name('admin.tickets.note');
});
