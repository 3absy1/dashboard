<?php

use Illuminate\Support\Facades\Route;
use Modules\ReferenceModule\App\Http\Controllers\ReferenceModuleController;

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

// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('access', function () {
//     return view('users-access');
// });
// Route::get('role', function () {
//     return view('users-roles');
// });
Route::get('/',[ReferenceModuleController::class,'home'])->name('home');
