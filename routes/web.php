<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function() {
    // Home Route
    Route::get('/', [UserController::class, 'index'])->name('home');

    // Admin Routes
    Route::get('/add-user', [UserController::class, 'addUser']);
    Route::post('/add-user', [UserController::class, 'add']);
    Route::get('/view-user/{id}', [UserController::class, 'ViewUser']);
    Route::post('/view-user/{id}', [UserController::class, 'edit']);
    Route::post('/delete-user/{id}', [UserController::class, 'delete']);

    // User Routes
    Route::get('/account/{id}', [UserController::class, 'viewAccount']);
    Route::get('/events', [WorkspaceController::class, 'viewEvents']);
    Route::post('/create-workspace', [WorkspaceController::class, 'createWorkspace']);
    Route::get('/your-workspace/{id}', [WorkspaceController::class, 'openWorkspace'])->name('workspace');
    Route::post('/edit-workspace/{id}', [WorkspaceController::class, 'editWorkspace']);
    Route::post('/delete-workspace/{id}', [WorkspaceController::class, 'deleteWorkspace']);
    Route::post('/create-list/{id}', [WorkspaceController::class, 'createList']);
    Route::post('/delete-list/{id}', [WorkspaceController::class, 'deleteList']);
    Route::post('/create-task/{id}', [WorkspaceController::class, 'createTask']);
    Route::get('/view-task/{id}', [WorkspaceController::class, 'viewTask']);
    Route::post('/edit-task/{id}', [WorkspaceController::class, 'editTask']);
    Route::post('/delete-task/{id}', [WorkspaceController::class, 'deleteTask']);
    Route::post('/create-post/{id}', [WorkspaceController::class, 'createPost']);
    Route::post('/move-task/{id}', [WorkspaceController::class, 'moveTask']);
});
