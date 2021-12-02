<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SelcompController;

Cache::flush();
Session::flush();
Artisan::call('cache:clear');

Route::get('/',[SelcompController::class, 'index'])->name('index');
Route::post('crearRadicado',[SelcompController::class, 'CrearRadicado'])->name('crearRadicado');
Route::post('actualizarRadicado',[SelcompController::class, 'ActualizarRadicado'])->name('actualizarRadicado');
Route::post('finalizarRadicado',[SelcompController::class, 'FinalizarRadicado'])->name('finalizarRadicado');
