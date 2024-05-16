<?php

use Illuminate\Support\Facades\Route;
use Modules\ReferenceModule\App\Http\Controllers\ReferenceModuleController;
use Modules\ReferenceModule\App\Http\Controllers\RelatedController;

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

// Route::group([], function () {
//     Route::resource('referencemodule', ReferenceModuleController::class)->names('referencemodule');
// });
Route::get('/dashboard',[ReferenceModuleController::class,'index'])->name('dashboard');



Route::get('/reference', [ReferenceModuleController::class,'show'])->name('reference');
Route::get('/reference/create', [ReferenceModuleController::class, 'create'])->name('reference.create');
Route::put('/reference/{access}', [ReferenceModuleController::class, 'update'])->name('reference.update');
Route::delete('/reference/{id}', [ReferenceModuleController::class, 'delete'])->name('reference.delete');



Route::get('related',[RelatedController::class,'index'] )->name('related');
Route::get('/related/create', [RelatedController::class, 'create'])->name('related.create');
Route::put('/related/{access}', [RelatedController::class, 'update'])->name('related.update');
Route::delete('/related/{id}', [RelatedController::class, 'delete'])->name('related.delete');


Route::post('/upload-file', [ReferenceModuleController::class, 'uploadFile'])->name('upload.file');
Route::post('/import', [ReferenceModuleController::class, 'upload'])->name('import.upload');
Route::get('/export', [ReferenceModuleController::class, 'export'])->name('export.data');

