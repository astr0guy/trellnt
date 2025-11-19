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

Route::get('/tasks', [TaskController::class, 'index'])->middleware("auth")->name('tasks');

Route::get('/this-workspace', [WorkspaceController::class, 'show'])->middleware("auth")->name('this_workspace');

Route::post('/workspace', [WorkspaceController::class, 'store'])->middleware("auth");

Route::delete('/workspace', [WorkspaceController::class, 'destroy'])->middleware("auth");

Route::get('/workspace', [WorkspaceController::class, 'index'])->middleware("auth")->name('workspace');

Route::post('/new-task', [TaskController::class, 'create'])->middleware("auth")->name('new-task');



require __DIR__.'/settings.php';


