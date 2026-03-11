<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');


Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/admin/materias', [adminController::class,'indexMaterias'])->name('index.materias');
Route::post('/admin/materia',[adminController::class,'saveMateria'])->name('save.materia');

Route::delete('/admin/eliminarmateria/{id}',[adminController::class,'deleteMateria'])->name('delete.materia');
Route::post('/admin/modificarmateria/{id}',[adminController::class,'updateMateria'])->name('update.materia');

Route::get('/admin/modificarmateria/{id}', [adminController::class,'editMateria'])->name('edit.materia');   
Route::put('/admin/modificarmateria/{id}', [adminController::class,'updateMateria'])->name('update.materia'); 

