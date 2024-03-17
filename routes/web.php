<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('prestamo');
})->middleware(['auth', 'verified'])->name('prestamo');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/inicio', [adminController::class, 'inicioUsuario'])->name('inicio.usuario');
    Route::get('/persona', [adminController::class, 'persona'])->name('persona.inicio');
    Route::get('/libro', [adminController::class, 'libro'])->name('libro.inicio');
    Route::get('/prestamo', [adminController::class, 'prestamo'])->name('prestamo.inicio');

    //Agregar persona
    Route::post('/persona', [adminController::class, 'nuevaPersona'])->name('nueva.persona');
    //Eliminar persona
    Route::get('/persona/{id}', [adminController::class, 'eliminarPersona'])->name('eliminar.persona');
    //Actualizar persona
    Route::post('/persona/{id}', [adminController::class, 'actualizarPersona'])->name('actualizar.persona');

    //Agregar libro
    Route::post('/libro', [adminController::class, 'nuevoLibro'])->name('nuevo.libro');
    //Eliminar libro
    Route::get('/libro/{id}', [adminController::class, 'eliminarLibro'])->name('eliminar.libro');
    //Actualizar libro
    Route::post('/libro/{id}', [adminController::class, 'actualizarLibro'])->name('actualizar.libro');

    //Prestamo
    Route::post('/prestamo', [adminController::class, 'nuevoPrestamo'])->name('nuevo.prestamo');
    //Eliminar prestamo
    Route::get('/prestamo/{id}', [adminController::class, 'eliminarPrestamo'])->name('eliminar.prestamo');
    //Actualizar prestamo
    Route::post('/prestamo/{id}', [adminController::class, 'actualizarPrestamo'])->name('actualizar.prestamo');

    Route::post('/prestamo/{id}', [adminController::class, 'devolverPrestamo'])->name('devolver.prestamo');
});

require __DIR__.'/auth.php';
