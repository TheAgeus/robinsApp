<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\MailController;


Route::get('/', [HomeController::class, 'login'])->name('welcome');
Route::get('/login', [HomeController::class, 'login'])->name('welcome');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


// Auth functionality
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');



/* ************************* */
/* EMPRESA CONTROLLER ROUTES */
/* ************************* */

// Crear empresa
Route::post('empresas/create', [EmpresaController::class, 'create'])->name('empresas/create')->middleware('auth');
Route::get('/dashboard/empresa/{id}', [EmpresaController::class, 'show'])->middleware('auth');

// Member upload files link
Route::get('empresa/uploadLink/{id}', [EmpresaController::class, 'uploadLink'])->name('uploadLink')->middleware('auth');

// Member upload files route
Route::post('empresa/uploadFiles', [EmpresaController::class, 'uploadFiles'])->name('uploadFiles');

// Generar link empresa
Route::post('generaLinkEmpresa', [EmpresaController::class, 'generaLinkEmpresa'])->name('generaLinkEmpresa')->middleware('auth');

// Enviar correo al robin
Route::post('sendMail', [MailController::class, 'sendMail'])->name('sendMail')->middleware('auth');



/* *********************** */
/* SOCIO CONTROLLER ROUTES */
/* *********************** */
Route::get('showPdf/comprobanteDomicilio/{id}', [SocioController::class, 'showComprobanteDomicilio'])->name('showComprobanteDomicilio')->middleware('auth');
Route::get('showPdf/actaNacimiento/{id}', [SocioController::class, 'showActaNacimiento'])->name('showActaNacimiento')->middleware('auth');
Route::get('showPdf/ine/{id}', [SocioController::class, 'showIne'])->name('showIne')->middleware('auth');
Route::get('showPdf/actaMatrimonio/{id}', [SocioController::class, 'showActaMatrimonio'])->name('showActaMatrimonio')->middleware('auth');
Route::get('showPdf/constanciaSituacionFiscal/{id}', [SocioController::class, 'showConstanciaSituacionFiscal'])->name('showConstanciaSituacionFiscal')->middleware('auth');