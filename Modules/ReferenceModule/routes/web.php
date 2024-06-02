<?php

use Modules\ReferenceModule\App\Http\Controllers\MergeController;
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
Route::get('/',[ReferenceModuleController::class,'home'])->name('home');

Route::get('/dashboard',[ReferenceModuleController::class,'index'])->name('dashboard');
Route::get('/search',[ReferenceModuleController::class,'search'])->name('search');



Route::get('/reference', [ReferenceModuleController::class,'show'])->name('reference');
Route::get('/reference/create', [ReferenceModuleController::class, 'create'])->name('reference.create');
Route::put('/reference/{access}', [ReferenceModuleController::class, 'update'])->name('reference.update');
Route::delete('/reference/{id}', [ReferenceModuleController::class, 'delete'])->name('reference.delete');
Route::post('/upload-file-reference', [ReferenceModuleController::class, 'referenceUploadFile'])->name('uploadupload-file-reference');
Route::post('/upload-reference', [ReferenceModuleController::class, 'uploadReference'])->name('upload.reference');
Route::get('/show', [ReferenceModuleController::class, 'validAndWaste'])->name('reference.show');
Route::post('/approve-reference', [ReferenceModuleController::class, 'approveReference'])->name('approve.reference');



Route::get('related',[RelatedController::class,'index'] )->name('related');
Route::post('/related/create', [RelatedController::class, 'create'])->name('related.create');
Route::post('/related/new', [RelatedController::class, 'new'])->name('related.new');
Route::put('/related/{access}', [RelatedController::class, 'update'])->name('related.update');
Route::put('/referenceinsert/{id}', [RelatedController::class, 'referenceinsert'])->name('reference.insert');
Route::delete('/related/{id}', [RelatedController::class, 'delete'])->name('related.delete');
Route::post('/upload-related', [RelatedController::class, 'uploadRelated'])->name('upload.related');
Route::post('/upload-file-related', [RelatedController::class, 'relatedUploadFile'])->name('uploadupload-file-related');


Route::get('merge',[MergeController::class,'index'] )->name('merge');
Route::post('/merge-upload-file', [MergeController::class, 'uploadFile'])->name('merge.upload.file');
Route::post('/merge-file', [MergeController::class, 'uploadMerge'])->name('merge.file');
Route::get('/export-merge', [MergeController::class, 'export'])->name('export.merge');


Route::post('/upload-file', [ReferenceModuleController::class, 'uploadFile'])->name('upload.file');
Route::post('/import', [ReferenceModuleController::class, 'upload'])->name('import.upload');



Route::get('/export', [ReferenceModuleController::class, 'export'])->name('export.data');
Route::get('/waste', [ReferenceModuleController::class, 'wasteexport'])->name('export.waste');

