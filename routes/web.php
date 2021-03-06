<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UtensilController;
use App\Http\Controllers\DishwashingController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('utensils', [UtensilController::class, 'index'])
    ->name('utensils.index')
    ->middleware('auth');

Route::get('utensils/create', [UtensilController::class, 'create'])
    ->name('utensils.create')
    ->middleware('auth');

Route::post('utensils', [UtensilController::class, 'store'])
    ->name('utensils.store')
    ->middleware('auth');

Route::post('utensils/use', [UtensilController::class, 'useUtensils'])
    ->name('utensils.use')
    ->middleware('auth');

Route::post('utensils/wash', [UtensilController::class, 'washUtensils'])
    ->name('utensils.wash')
    ->middleware('auth');

Route::get('dishwashing', [DishwashingController::class, 'index'])
    ->name('dishwashing.index')
    ->middleware('auth');