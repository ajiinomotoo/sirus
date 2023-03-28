<?php

use App\Models\rsmstOut;
use App\Models\rsmstMstDiag;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RsmstJobController;
use App\Http\Controllers\RsmstOutController;
use App\Http\Controllers\RsmstPoliController;
use App\Http\Controllers\TkmstKotaController;
use App\Http\Controllers\TkmstProvController;
use App\Http\Controllers\RsmstMstDiagController;
use App\Http\Controllers\TkmstProfileController;
use App\Http\Controllers\RsmstPropinsiController;
use App\Http\Controllers\RsmstReligionController;
use App\Http\Controllers\RsmstEducationController;
use App\Http\Controllers\RsmstEntryTypeController;
use App\Http\Controllers\RsmstKecamatanController;
use App\Http\Controllers\RsmstKlaimTypeController;
use App\Http\Controllers\RsmstParameterController;

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

Route::get('/', function () {
    return view('dashboard');
});

// Rsmst
Route::resource('medis/poli', RsmstPoliController::class);
Route::resource('medis/entrytype', RsmstEntryTypeController::class);
Route::resource('medis/klaimtype', RsmstKlaimTypeController::class);
Route::resource('medis/mstdiag', RsmstMstDiagController::class);
Route::resource('medis/parameter', RsmstParameterController::class);
Route::resource('nonMedis/education', RsmstEducationController::class);
Route::resource('nonMedis/out', RsmstOutController::class);
Route::resource('nonMedis/job', RsmstJobController::class);
Route::resource('nonMedis/religion', RsmstReligionController::class);
Route::resource('nonMedis/kecamatan', RsmstKecamatanController::class);


// Tkmst
Route::resource('nonMedis/profile', TkmstProfileController::class);
// Route::resource('nonMedis/propinsi', RsmstPropinsiController::class);
Route::resource('nonMedis/provinsi', TkmstProvController::class);
Route::resource('nonMedis/kota', TkmstKotaController::class);
