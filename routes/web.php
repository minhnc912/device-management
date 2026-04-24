<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/users/create', [UserController::class, 'create'])
        ->middleware('permission:users.create')
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware('permission:users.create')
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('permission:users.edit')
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->middleware('permission:users.edit')
        ->name('users.update');

    Route::delete('/users/{user}')->middleware('permission:users.delete')->name('users.destroy');

    Route::resource('roles', RoleController::class)
        ->except(['show'])
        ->middleware('permission:manage roles');

    Route::prefix('roles/{role}')->group(function () {
        Route::get('permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');

        Route::post('permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    });

    Route::prefix('users/{user}')->group(function () {
        Route::get('roles', [UserController::class, 'editRoles'])->name('users.roles.edit');

        Route::post('roles', [UserController::class, 'updateRoles'])->name('users.roles.update');
    });
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
});

require __DIR__ . '/auth.php';
