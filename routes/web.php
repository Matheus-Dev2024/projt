<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContasController;

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

Route::get('/', [ContasController::class, 'index'])-> name('contas.index');
Route::get('/contas/create',[ContasController::class, 'create'])->name('contas.create');
Route::post('/contas/store', [ContasController::class, 'store'])->name('contas.store');
Route::get('/contas/show/{conta}',[ContasController::class, 'show'])->name('contas.show');
Route::get('/contas/edit/{conta}', [ContasController::class, 'edit'])->name('contas.edit');
Route::put('/contas/update/{conta}', [ContasController::class, 'update'])->name('contas.update');
Route::delete('/contas/destroy/{conta}', [ContasController::class, 'destroy'])->name('contas.destroy');
Route::get('/contas/change-situation/{conta}', [ContasController::class, 'changeSituation'])->name('contas.change-situation');
Route::get('/gerar-pdf-conta', [ContasController::class, 'gerarpdf'])-> name('contas.gerar-pdf');



