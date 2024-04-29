<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TableHomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Livewire\ClientsTable;

use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', [TableHomeController::class, 'index'])->name('home');
    Route::get('/clients/{id}', [TableHomeController::class, 'show'])->name('client.show');
    Route::get('/clients/{id}/edit', [TableHomeController::class, 'edit'])->name('client.edit');
    Route::get('/client/create', [TableHomeController::class, 'create'])->name('client.create');

    Route::get('/company', [CompanyController::class, 'index'])->name('company');
    Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company.show');
    Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::resource('companies', CompanyController::class);
    // Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');



});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->route('admin.dashboard');
});
