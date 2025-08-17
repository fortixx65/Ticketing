<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin\CheckPerms;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\Projects\ProjectsController;
use App\Http\Controllers\admin\Tickets\TicketsController;
use App\Http\Controllers\admin\Users\UsersController;
use App\Http\Controllers\admin\Configurations\RolesController;
use App\Http\Controllers\admin\Tickets\TypesController;
use App\Http\Controllers\admin\Tickets\PriorityController;
use App\Http\Controllers\admin\Permissions\PermissionsController;
use App\Http\Controllers\admin\Permissions\RolePermissionsController;

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


Route::get('/', [AdminController::class, 'index'])->name('index');
// Action/Profile ALL NOK

// Permission NOK
Route::prefix('projects')->name('projects.')->group(function() {
    Route::get('/', [ProjectsController::class, 'index'])->name('index');
    Route::post('/create', [ProjectsController::class, 'create'])->name('create');
    Route::prefix('{id}')->group(function() {
        Route::get('/', [ProjectsController::class, 'action'])->name('action');
        Route::prefix('tickets')->group(function() {
            Route::get('/', [ProjectsController::class, 'tickets'])->name('tickets');
        });
        Route::prefix('permissions')->group(function() {
            Route::get('/', [ProjectsController::class, 'permissions'])->name('permissions');
        });
        Route::get('/edit', [ProjectsController::class, 'edit'])->name('edit');
        Route::post('/edit', [ProjectsController::class, 'editer'])->name('editer');
        Route::get('/delete', [ProjectsController::class, 'delete'])->name('delete');
        Route::get('/On', [ProjectsController::class, 'on'])->name('on');
        Route::get('/Off', [ProjectsController::class, 'off'])->name('off');
    });
});
// Message NOK
Route::prefix('tickets')->name('tickets.')->group(function() {
    Route::get('/', [TicketsController::class, 'index'])->name('index');
    Route::post('/create', [TicketsController::class, 'create'])->name('create');
    Route::prefix('{id}')->group(function() {
        Route::get('/', [TicketsController::class, 'action'])->name('action');
        Route::prefix('messages')->group(function() {
            Route::get('/', [TicketsController::class, 'messages'])->name('messages');
        });
        Route::prefix('project')->group(function() {
            Route::get('/', [TicketsController::class, 'project'])->name('project');
        });
        Route::get('/edit', [TicketsController::class, 'edit'])->name('edit');
        Route::post('/edit', [TicketsController::class, 'editer'])->name('editer');
        Route::get('/delete', [TicketsController::class, 'delete'])->name('delete');
        Route::get('/close', [TicketsController::class, 'close'])->name('close');
        Route::get('/open', [TicketsController::class, 'open'])->name('open');
    });
});
// Route OK
Route::prefix('users')->name('users.')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::post('/create', [UsersController::class, 'create'])->name('create');
    Route::prefix('{id}')->group(function() {
        Route::get('/', [UsersController::class, 'profil'])->name('profil');
        Route::get('/logs', [UsersController::class, 'logs'])->name('logs');
        Route::get('/edit', [UsersController::class, 'edit'])->name('edit');
        Route::post('/edit', [UsersController::class, 'editer'])->name('editer');
        Route::get('/On', [UsersController::class, 'on'])->name('on');
        Route::get('/Off', [UsersController::class, 'off'])->name('off');
        Route::get('/delete', [UsersController::class, 'delete'])->name('delete');
    });
});
// Route OK
Route::prefix('roles')->name('roles.')->group(function() {
    Route::get('/', [RolesController::class, 'index'])->name('index');
    Route::post('/create', [RolesController::class, 'create'])->name('create');
    Route::prefix('{id}')->group(function() {
        Route::get('/', [RolesController::class, 'profil'])->name('profil');
        Route::get('/permission', [RolePermissionsController::class, 'permission'])->name('permission');
        Route::post('/permission', [RolePermissionsController::class, 'update'])->name('update');
        Route::get('/users', [RolesController::class, 'users'])->name('users');
        Route::get('/edit', [RolesController::class, 'edit'])->name('edit');
        Route::post('/edit', [RolesController::class, 'editer'])->name('editer');
        Route::get('/delete', [RolesController::class, 'delete'])->name('delete');
    });
});
// Route OK
Route::prefix('types')->name('types.')->group(function() {
    Route::get('/', [TypesController::class, 'index'])->name('index');
    Route::post('/create', [TypesController::class, 'create'])->name('create');
    Route::prefix('{id}')->group(function() {
        Route::get('/', [TypesController::class, 'profil'])->name('profil');
        Route::get('/edit', [TypesController::class, 'edit'])->name('edit');
        Route::post('/edit', [TypesController::class, 'editer'])->name('editer');
        Route::get('/delete', [TypesController::class, 'delete'])->name('delete');
    });
});
// Route OK
Route::prefix('priority')->name('priority.')->group(function() {
    Route::get('/', [PriorityController::class, 'index'])->name('index');
    Route::post('/create', [PriorityController::class, 'create'])->name('create');
    Route::prefix('{id}')->group(function() {
        Route::get('/', [PriorityController::class, 'action'])->name('action');
        Route::get('/edit', [PriorityController::class, 'edit'])->name('edit');
        Route::post('/edit', [PriorityController::class, 'editer'])->name('editer');
        Route::get('/delete', [PriorityController::class, 'delete'])->name('delete');
    });
});

// Route OK
Route::prefix('permissions')->name('permissions.')->group(function() {
    Route::prefix('roles')->name('roles.')->group(function() {
        Route::get('/', [RolePermissionsController::class, 'index'])->name('index');
        Route::post('/create', [RolePermissionsController::class, 'create'])->name('create');
        Route::prefix('{id}')->group(function() {
            Route::get('/', [RolePermissionsController::class, 'profil'])->name('profil');
            Route::get('/edit', [RolePermissionsController::class, 'edit'])->name('edit');
            Route::post('/edit', [RolePermissionsController::class, 'editer'])->name('editer');
            Route::get('/delete', [RolePermissionsController::class, 'delete'])->name('delete');
        });
    });
});


// require __DIR__.'/auth.php';
