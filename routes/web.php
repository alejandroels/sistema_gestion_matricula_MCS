<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatriculaController;

// use App\Http\Controllers\MatriculaController;

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

Route::get('/', function () {
    return view('home');
})
->middleware('auth');

Route::get('/register',[RegisterController::class, 'create'])
->middleware('guest')
->name('register.index');

Route::post('/register',[RegisterController::class, 'store'])
->name('register.store');



Route::get('/login',[SessionsController::class, 'create'])
->middleware('guest')
->name('login.index');

Route::post('/login',[SessionsController::class, 'store'])
->name('login.store');

Route::get('/logout',[SessionsController::class, 'destroy'])
->middleware('auth')
->name('login.destroy');

 Route::get('/admin', [AdminController::class, 'index'])
 ->middleware('auth.admin')
 ->name('admin.index');

 Route::get('/coordinator', [CoordinatorController::class, 'index'])
 ->middleware('auth.coordinator')
 ->name('coordinator.index');

 Route::resource('evidencias',App\Http\Controllers\EvidenciaController::class);

 Route::get('/evidencia/showByUser/{user_id}', [EvidenciaController::class, 'showByUser'])
 ->name('evidencia.showByUser');

 

 Route::get('/evidencia/status/{user_id}', [EvidenciaController::class, 'status'])
 ->name('evidencia.status');

 Route::get('evidencia/{user_id}/edit', [EvidenciaController::class, 'edit'])
 ->name('evidencia.edit');


 Route::delete('/evidencia/{user_id}', [EvidenciaController::class, 'destroy'])
 ->name('evidencia.destroy');


 Route::get('/evidencia/{evidencia}/accept', [EvidenciaController::class, 'accept'])->name('evidencia.accept');
 Route::get('/evidencia/{evidencia}/matriculaAcept', [EvidenciaController::class, 'accept'])->name('evidencia.accept');

 Route::get('/evidencia/{evidencia}/rectific', [EvidenciaController::class, 'rectific'])->name('evidencia.rectific');
Route::get('/evidencia/{evidencia}/deny', [EvidenciaController::class, 'deny'])->name('evidencia.deny');

Route::get('/evidencia/search', [EvidenciaController::class, 'search'])->name('evidencia.search');

Route::get('/request', [EvidenciaController::class, 'requests'])->name('evidencia.requests');


Route::resource('users',App\Http\Controllers\UserController::class);

Route::get('/user/search', [EvidenciaController::class, 'search'])->name('user.search');

Route::post('/matricula/{evidencia}/store', [MatriculaController::class, 'store'])->name('matriculas.store');

Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');

Route::get('/matriculas/create', [MatriculaController::class, 'create'])->name('matriculas.create');

Route::delete('/matriculas/{matricula}', [MatriculaController::class, 'destroy'])->name('matriculas.destroy');

Route::get('/matriculas/{matricula}', [MatriculaController::class, 'show'])->name('matriculas.show');

Route::get('/matriculas/{matricula}/edit', [MatriculaController::class, 'edit'])->name('matriculas.edit');

Route::match(['put', 'patch'], '/matriculas/{matricula}', [MatriculaController::class, 'update'])->name('matriculas.update');


Route::put('/matriculas/{id}/darBaja', [MatriculaController::class, 'darBaja'])->name('matriculas.darBaja');

Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');

Route::get('/evidencia/searchRequests', [EvidenciaController::class, 'searchRequests'])->name('evidencia.searchRequests');

Route::get('/matricula/search', [MatriculaController::class, 'search'])->name('matricula.search');

Route::post('/evidencias/{evidencia_id}/createMatricula', [EvidenciaController::class, 'createMatricula'])->name('evidencia.createMatricula');
