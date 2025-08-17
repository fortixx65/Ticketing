<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tickets\ClientsController;
use App\Http\Controllers\Tickets\SupportsController;
use App\Http\Controllers\Tickets\DevsController;

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

Route::get('/', [Controller::class, 'index'])->name('index');

Route::prefix('tickets')->name('tickets.')->group(function() {
    Route::prefix('clients')->name('clients.')->group(function() {
        Route::get('/', [ClientsController::class, 'index'])->name('index');
        Route::post('/create', [RolesController::class, 'create'])->name('create');
        Route::prefix('{id}')->group(function() {
            Route::get('/', [RolesController::class, 'profil'])->name('profil');
            Route::get('/permission', [RolesController::class, 'permission'])->name('permission');
            Route::get('/security', [RolesController::class, 'security'])->name('security');
            Route::get('/edit', [RolesController::class, 'edit'])->name('edit');
            Route::post('/edit', [RolesController::class, 'editer'])->name('editer');
            Route::get('/On', [RolesController::class, 'on'])->name('on');
            Route::get('/Off', [RolesController::class, 'off'])->name('off');
            Route::get('/delete', [RolesController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('supports')->name('supports.')->group(function() {
        Route::get('/', [SupportsController::class, 'index'])->name('index');
        Route::prefix('{id}')->group(function() {
            Route::get('/', [SupportsController::class, 'news'])->name('news');
            Route::prefix('in_progress')->group(function() {
                Route::get('/', [SupportsController::class, 'in_progress'])->name('in_progress');
            });
            Route::prefix('documentation')->group(function() {
                Route::get('/', [SupportsController::class, 'documentation'])->name('documentation');
            });
            Route::prefix('acquit')->group(function() {
                Route::get('/', [SupportsController::class, 'acquit'])->name('acquit');
                Route::post('/add', [SupportsController::class, 'message_Add'])->name('message_Adda');
            });
            Route::prefix('view')->group(function() {
                Route::get('/', [SupportsController::class, 'view'])->name('view');
                Route::post('/add', [SupportsController::class, 'message_Add'])->name('message_Add');
            });
        });
    });
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
