<?php

use App\Http\Controllers\RjslideController;
use App\Models\rsmstPasien;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RsmstJobController;
use App\Http\Controllers\RsmstOutController;
use App\Http\Controllers\RsmstDesaController;
use App\Http\Controllers\RsmstPoliController;
use App\Http\Controllers\TkmstKotaController;
use App\Http\Controllers\TkmstProvController;
use App\Http\Controllers\RsmstDoctorController;
use App\Http\Controllers\RsmstPasienController;
use App\Http\Controllers\RstxnRjhdrsController;
use App\Http\Controllers\RsmstMstDiagController;
use App\Http\Controllers\TkmstProfileController;
use App\Http\Controllers\RsmstPropinsiController;
use App\Http\Controllers\RsmstReligionController;
use App\Http\Controllers\RsmstEducationController;
use App\Http\Controllers\RsmstEntryTypeController;
use App\Http\Controllers\RsmstKabupatenController;
use App\Http\Controllers\RsmstKecamatanController;
use App\Http\Controllers\RsmstKlaimTypeController;
use App\Http\Controllers\RsmstParameterController;
use App\Http\Controllers\RstxnRjhdrsSlideController;
use App\Http\Controllers\RstxnRjhdrsOnlineController;

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

// Route::get('rjslide', function () {
//     return view('default');
// });
// Route::get('/rawatjalanRjno', [RjslideController::class, 'myRjno'])->name('rawatjalanRjno');
// Route::get('/getRegno', [RjslideController::class, 'getRegno'])->name('getRegno');

// Route Rawat Jalan Form Slide
Route::resource('medis/rjslide', RstxnRjhdrsSlideController::class);
Route::get('/rawatjalanRjno', [RstxnRjhdrsSlideController::class, 'myRjno'])->name('rawatjalanRjno');
Route::get('/getRegno', [RstxnRjhdrsSlideController::class, 'getRegno'])->name('getRegno');
// End Route Rawat Jalan Form Slide


// Route Pasien (Tambahan)
Route::get('/pasienRegno', [RsmstPasienController::class, 'myregno'])->name('pasienRegno');
// End Route Pasien (Tambahan)


// Route RJ (Tambahan)
Route::get('/rawatjalanRjno', [RstxnRjhdrsController::class, 'myRjno'])->name('rawatjalanRjno');
Route::get('/getRegno', [RstxnRjhdrsController::class, 'getRegno'])->name('getRegno');
// Route::get('/autofill', [RstxnRjhdrsController::class, 'autofill'])->name('autofill');
// End Route RJ (Tambahan)


// Route RJ Online (Tambahan)
Route::get('/rawatjalanRjno', [RstxnRjhdrsOnlineController::class, 'myRjno'])->name('rawatjalanRjno');
Route::get('/autofillrjonline', [RstxnRjhdrsOnlineController::class, 'autofillrjonline'])->name('autofillrjonline');
// End Route RJ Online (Tambahan)


// Rsmst
Route::resource('medis/pasien', RsmstPasienController::class);
Route::resource('medis/rawatjalan', RstxnRjhdrsController::class);
Route::resource('medis/rjonline', RstxnRjhdrsOnlineController::class);
Route::resource('medis/doctor', RsmstDoctorController::class);
Route::resource('medis/poli', RsmstPoliController::class);
Route::resource('medis/entrytype', RsmstEntryTypeController::class);
Route::resource('medis/klaimtype', RsmstKlaimTypeController::class);
Route::resource('medis/mstdiag', RsmstMstDiagController::class);
Route::resource('medis/parameter', RsmstParameterController::class);
Route::resource('nonMedis/education', RsmstEducationController::class);
Route::resource('nonMedis/out', RsmstOutController::class);
Route::resource('nonMedis/job', RsmstJobController::class);
Route::resource('nonMedis/religion', RsmstReligionController::class);
Route::resource('nonMedis/propinsi', RsmstPropinsiController::class);
Route::resource('nonMedis/kabupaten', RsmstKabupatenController::class);
Route::resource('nonMedis/kecamatan', RsmstKecamatanController::class);
Route::resource('nonMedis/desa', RsmstDesaController::class);


// Tkmst
Route::resource('nonMedis/profile', TkmstProfileController::class);
Route::resource('nonMedis/provinsi', TkmstProvController::class);
Route::resource('nonMedis/kota', TkmstKotaController::class);
