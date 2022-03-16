<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CustomersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('setup', function () {
   return inertia('Wizard/AccountSetup');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('invoice/send-mail/{id}', 'sendMail')->name('invoice.send_mail');
        Route::delete('invoice/delete-info/{description}', 'deleteInfo')->name('invoice.delete_info');
    });

    Route::controller(SettingsController::class)->group(function () {
        Route::name('settings.')->prefix('user')->group(function () {
            Route::post('settings', 'updateCompany')->name('update-company');
            Route::delete('settings', 'deleteLogo')->name('delete-logo');
        });
    });

    Route::resource('invoice', InvoiceController::class);
    Route::resource('customers', CustomersController::class);
});
