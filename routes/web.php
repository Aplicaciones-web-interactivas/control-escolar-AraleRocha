<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\adminHyG_Controller;
use App\Http\Controllers\adminCalController;
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

//Rutas para calificaciones
Route::get('/admin/calificaciones',[adminCalController::class,'indexCalificaciones'])->name('index.calificaciones');
Route::post('/admin/calificacion',[adminCalController::class,'saveCalificacion'])->name('save.calificacion');
Route::delete('/admin/eliminarcalificacion/{id}',[adminCalController::class,'deleteCalificacion'])->name('delete.calificacion');
Route::get('/admin/modificarcalificacion/{id}',[adminCalController::class,'editCalificacion'])->name('edit.calificacion');
Route::put('/admin/calificacion/{id}',[adminCalController::class,'updateCalificacion'])->name('update.calificacion');

//Rutas para inscripciones
Route::get('/admin/inscripciones',[adminCalController::class,'indexInscripciones'])->name('index.inscripciones');
Route::post('/admin/inscripcion',[adminCalController::class,'saveInscripcion'])->name('save.inscripcion');
Route::delete('/admin/eliminarinscripcion/{id}',[adminCalController::class,'deleteInscripcion'])->name('delete.inscripcion');
Route::get('/admin/modificarinscripcion/{id}',[adminCalController::class,'editInscripcion'])->name('edit.inscripcion');
Route::put('/admin/inscripcion/{id}',[adminCalController::class,'updateInscripcion'])->name('update.inscripcion');
