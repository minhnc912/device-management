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

    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:users.view')
        ->name('users.index');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->middleware('permission:users.view')
        ->name('users.show');

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
        ->middleware('permission:roles.view');

    Route::prefix('roles/{role}')->group(function () {
        Route::get('permissions', [RoleController::class, 'editPermissions'])
            ->middleware('permission:roles.permissions.manage')
            ->name('roles.permissions.edit');

        Route::post('permissions', [RoleController::class, 'updatePermissions'])
            ->middleware('permission:roles.permissions.manage')
            ->name('roles.permissions.update');
    });

    Route::prefix('users/{user}')->group(function () {
        Route::get('roles', [UserController::class, 'editRoles'])
            ->middleware('permission:users.edit')
            ->name('users.roles.edit');

        Route::post('roles', [UserController::class, 'updateRoles'])
            ->middleware('permission:users.edit')
            ->name('users.roles.update');
    });
});

require __DIR__ . '/auth.php';
