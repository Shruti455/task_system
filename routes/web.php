<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/check-email-unique', [HomeController::class, 'email_check'])->name('checkEmailUnique');


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/task', [HomeController::class, 'task'])->name('task');
    Route::post('/create_task', [HomeController::class, 'create_task'])->name('create_task');
    Route::get('/delete_task/{id}', [HomeController::class, 'delete_task'])->name('delete_task');
    Route::post('/update_task/{id}', [HomeController::class, 'update_task'])->name('update_task');

    Route::get('/task-details/{id}', [HomeController::class, 'task_details'])->name('task_details');
    Route::post('/status/{id}', [HomeController::class, 'status'])->name('status');
});

// Admin login routes
Route::prefix('admin/')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');

    
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('task', [AdminController::class, 'task'])->name('task');
        Route::post('/create_task', [AdminController::class, 'create_task'])->name('create_task');
        Route::get('/delete_task/{id}', [AdminController::class, 'delete_task'])->name('delete_task');
        Route::post('/update_task/{id}', [AdminController::class, 'update_task'])->name('update_task');
        Route::get('/task-details/{id}', [AdminController::class, 'task_details'])->name('task_details');
        Route::post('/user_and_status/{id}', [AdminController::class, 'user_and_status'])->name('user_and_status');

        Route::get('tasks/export', [AdminController::class, 'task_export'])->name('tasks.export');
        Route::get('users/export', [AdminController::class, 'user_export'])->name('users.export');

        Route::get('user-list', [AdminController::class, 'user_list'])->name('user_list');
        Route::get('create/user', [AdminController::class, 'create_user'])->name('create.user');
        Route::post('save_user', [AdminController::class, 'save_user'])->name('save_user');
    });
});
?>