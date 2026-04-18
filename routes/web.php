<?php

use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/widget', [WidgetController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/tickets/{id}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::post('/tickets/{id}/status', [AdminTicketController::class, 'updateStatus'])->name('admin.tickets.updateStatus');
});
