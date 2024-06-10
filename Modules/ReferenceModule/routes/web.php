<?php

use Modules\ReferenceModule\App\Http\Controllers\MergeController;
use Illuminate\Support\Facades\Route;
use Modules\ReferenceModule\App\Http\Controllers\CheckController;
use Modules\ReferenceModule\App\Http\Controllers\ReferenceController;
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


Route::prefix('checkPage')->group(function () {
    Route::get('/',[CheckController::class,'index'])->name('check.index');
    Route::get('/search',[CheckController::class,'search'])->name('check.search');
    Route::post('/match-columns', [CheckController::class, 'matchColumns'])->name('check.matchColumns');
    Route::post('/import', [CheckController::class, 'import'])->name('check.import');
    Route::get('/export', [CheckController::class, 'export'])->name('check.export');

});

Route::prefix('referencePage')->group(function () {

        Route::get('/', [ReferenceController::class,'index'])->name('reference.index');
        Route::get('/create', [ReferenceController::class, 'create'])->name('reference.create');
        Route::put('/{reference}', [ReferenceController::class, 'update'])->name('reference.update');
        Route::get('/{reference}/edit', [ReferenceController::class, 'edit'])->name('reference.edit');
        Route::delete('/{id}', [ReferenceController::class, 'delete'])->name('reference.delete');
        Route::post('/import-file', [ReferenceController::class, 'importFile'])->name('reference.import-File');
        Route::post('/upload-reference', [ReferenceController::class, 'uploadReference'])->name('upload.reference');
        Route::get('/validAndWaste', [ReferenceController::class, 'validAndWaste'])->name('reference.valid-Waste');
        Route::post('/reference-approve', [ReferenceController::class, 'RreferenceApprove'])->name('reference.approve');
        Route::get('/export', [ReferenceController::class, 'export'])->name('reference.export');

    });

    Route::prefix('relatedPage')->group(function () {

        Route::get('/',[RelatedController::class,'index'] )->name('related.index');
        Route::post('/create', [RelatedController::class, 'create'])->name('related.create');
        // Route::post('/related/new', [RelatedController::class, 'checkcreate'])->name('related.new');
        Route::put('/{related}', [RelatedController::class, 'update'])->name('related.update');
        Route::get('/{related}/edit', [RelatedController::class, 'edit'])->name('related.edit');
        // Route::put('/referenceinsert/{id}', [RelatedController::class, 'referenceinsert'])->name('reference.insert');
        Route::delete('/{id}', [RelatedController::class, 'delete'])->name('related.delete');
        Route::post('/import-file', [RelatedController::class, 'importFile'])->name('related-import');
        Route::post('/related-upload', [RelatedController::class, 'relatedUpload'])->name('related-upload');

    });

    Route::prefix('mergePage')->group(function () {

        Route::get('/',[MergeController::class,'index'] )->name('merge.index');
        Route::post('/import-file', [MergeController::class, 'importfile'])->name('merge.import');
        Route::post('/merge-upload', [MergeController::class, 'mergeUpload'])->name('merge.upload');
        Route::get('/merge-file',[MergeController::class,'merge'] )->name('merge.file');
        Route::get('/export', [MergeController::class, 'export'])->name('merge.export');

    });

