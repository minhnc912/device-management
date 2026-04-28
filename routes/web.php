    <?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DeviceController;
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

        // User Management
        Route::resource('users', UserController::class);

        // Role Management
        Route::resource('roles', RoleController::class);

        // Role Permissions Management
        Route::prefix('roles/{role}')->group(function () {
            Route::get('permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');

            Route::post('permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
        });

        // User Roles Management
        Route::prefix('users/{user}')->group(function () {
            Route::get('roles', [UserController::class, 'editRoles'])->name('users.roles.edit');

            Route::post('roles', [UserController::class, 'updateRoles'])->name('users.roles.update');
        });

        // Devices Management
        Route::resource('devices', DeviceController::class);

        // Activity Logs
        Route::get('/logs', [ActivityLogController::class, 'index'])
            ->middleware('permission:logs.view')
            ->name('logs.index');
    });

    require __DIR__ . '/auth.php';
