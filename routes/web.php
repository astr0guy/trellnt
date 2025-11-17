<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');

Route::get('/this-workspace', [WorkspaceController::class, 'show'])->name('this_workspace');

Route::post('/workspace', [WorkspaceController::class, 'store']);

Route::delete('/workspace', [WorkspaceController::class, 'destroy']);

Route::get('/workspace', [WorkspaceController::class, 'index'])->name('workspace');

Route::post('/new-task', [TaskController::class, 'create'])->name('new-task');



// Route::post('/login', Login::class)
//     ->middleware('guest');


require __DIR__.'/settings.php';


