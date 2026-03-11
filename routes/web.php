<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\adminHyG_Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

// Rutas de autenticación
Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');


Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// Rutas para materias
Route::get('/admin/materias', [adminController::class,'indexMaterias'])->name('index.materias');
Route::post('/admin/materia',[adminController::class,'saveMateria'])->name('save.materia');

Route::delete('/admin/eliminarmateria/{id}',[adminController::class,'deleteMateria'])->name('delete.materia');
Route::post('/admin/modificarmateria/{id}',[adminController::class,'updateMateria'])->name('update.materia');

Route::get('/admin/modificarmateria/{id}', [adminController::class,'editMateria'])->name('edit.materia');   
Route::put('/admin/modificarmateria/{id}', [adminController::class,'updateMateria'])->name('update.materia'); 

// Rutas para grupos
Route::get('/admin/grupos', [adminHyG_Controller::class,'indexGrupos'])->name('index.grupos');
Route::post('/admin/grupo',[adminHyG_Controller::class,'saveGrupo'])->name('save.grupo');
Route::delete('/admin/eliminargrupo/{id}',[adminHyG_Controller::class,'deleteGrupo'])->name('delete.grupo');
Route::get('/admin/modificargrupo/{id}',[adminHyG_Controller::class,'editGrupo'])->name('edit.grupo');
Route::put('/admin/grupo/{id}',[adminHyG_Controller::class,'updateGrupo'])->name('update.grupo');


//Rutas para horarios
Route::get('/admin/horarios',[adminHyG_Controller::class,'indexHorarios'])->name('index.horarios');
Route::post('/admin/horario',[adminHyG_Controller::class,'saveHorario'])->name('save.horario');
Route::delete('/admin/eliminarhorario/{id}',[adminHyG_Controller::class,'deleteHorario'])->name('delete.horario');
Route::get('/admin/modificarhorario/{id}',[adminHyG_Controller::class,'editHorario'])->name('edit.horario');
Route::put('/admin/horario/{id}',[adminHyG_Controller::class,'updateHorario'])->name('update.horario');
