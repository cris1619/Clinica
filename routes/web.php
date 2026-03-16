<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Admin\CitaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin', function () {
        return view('administrador.dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth','role:administrador'])->prefix('admin')->group(function () {

    Route::get('/usuarios', [AdminUserController::class,'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [AdminUserController::class,'create'])->name('usuarios.create');
    Route::post('/usuarios', [AdminUserController::class,'store'])->name('usuarios.store');
    Route::get('/usuarios/{user}/edit', [AdminUserController::class,'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}', [AdminUserController::class,'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [AdminUserController::class,'destroy'])->name('usuarios.destroy');
    Route::put('/usuarios/{user}/rol', [AdminUserController::class,'updateRol'])->name('usuarios.updateRol');
});

Route::middleware(['auth','role:administrador,agente'])
->prefix('admin')
->group(function () {

    Route::resource('pacientes', PacienteController::class);
    Route::get('pacientes-trash',[PacienteController::class,'trash'])
->name('pacientes.trash');

Route::put('pacientes-restore/{id}',[PacienteController::class,'restore'])
->name('pacientes.restore');

Route::delete('pacientes-force-delete/{id}',[PacienteController::class,'forceDelete'])
->name('pacientes.forceDelete');

    Route::resource('citas', CitaController::class);

}); 

require __DIR__.'/auth.php';