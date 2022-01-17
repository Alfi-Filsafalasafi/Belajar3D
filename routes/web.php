<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\superAdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TugasSiswaController;
use App\Http\Controllers\MateriSiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\KuisSiswaController;
use App\Http\Controllers\DaftarSiswaController;
use App\Http\Controllers\MenuNilaiSiswaController;
use App\Http\Controllers\profilController;


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
    return view('auth.login');
});

//Admin
// Route::get('/berandaAdmin' , function() {
//     return view('admin.dashboard');
// });

//Guru

Route::group(['middleware' => ['hak_aksesGuru']], function (){


//----------------------MenuNilaiSiswa-----------------------------------
Route::get('/MenuNilaiSiswa', [MenuNilaiSiswaController::class, 'index']);
Route::get('/tugasSiswa/{siswa}', [MenuNilaiSiswaController::class, 'showTugas'])->name('nilai.tugasSiswa')->middleware('auth');
Route::get('/nilaitugasSiswa/{siswa}', [MenuNilaiSiswaController::class, 'showNilai'])->name('nilai.tugasSiswa.nilai')->middleware('auth');
Route::patch('/tugasSiswa/update', [MenuNilaiSiswaController::class, 'editKomentarTugas'])->name('nilai.tugasSiswa.komentar.update')->middleware('auth');
Route::patch('/nilaiSiswa/update', [MenuNilaiSiswaController::class, 'editNilaiTugas'])->name('nilai.tugasSiswa.nilai.update')->middleware('auth');


//----------------------MenuMateriSiswa----------------------------------
Route::get('/pengaturanMateri', [MateriController::class, 'index'])->name('materi.index')->middleware('auth');
Route::get('/tambahMateri', [MateriController::class, 'create'])->name('materi.create')->middleware('auth');
Route::post('/pengaturanMateri', [MateriController::class, 'store'])->name('materi.store')->middleware('auth');
Route::patch('/pengaturanMateri/{materi}', [MateriController::class, 'updateMateri'])->name('materi.update')->middleware('auth');
Route::get('/tugasMateri/{materi}', [MateriController::class, 'showTugas'])->name('materi.tugas.index')->middleware('auth');
Route::patch('/tugasMateri/{materi}', [MateriController::class, 'updateTugas'])->name('materi.tugas.update')->middleware('auth');
Route::get('/tugasMateri/{materi}/hapus', [MateriController::class, 'destroy'])->name('materi.delete')->middleware('auth');

//---------------------------MenuKuisMateri-----------------------------
Route::get('/kuisMateri/{kuis}', [KuisController::class, 'index'])->name('kuis.index')->middleware('auth');
Route::post('/kuisMateri', [KuisController::class, 'store'])->name('kuis.store')->middleware('auth');
Route::patch('/kuisMateri/edit', [KuisController::class, 'update'])->name('kuis.update')->middleware('auth');
Route::get('/kuisMateri/hapus/{kuis}',[KuisController::class, 'destroy'])->name('kuis.delete')->middleware('auth');


Route::get('/berandaAdmin',[AdminController::class, 'index'])->name('berandaGuru.index')->middleware('auth');
Route::get('/nilaiIndividu', [AdminController::class, 'nilaiIndividu']);
Route::patch('/profilGuru/{user}/edit', [profilController::class, 'updateGuru'])->name('profilGuru.update')->middleware('auth');

});


//Siswa
Route::group(['middleware' => ['hak_akses']], function (){
    Route::get('/berandaSiswa', [SiswaController::class, 'berandaSiswa'])->name('berandaSiswa.index')->middleware('auth');
    Route::get('/kuis/{materi}', [kuisSiswaController::class, 'index'])->name('kuisSiswa.index')->middleware('auth');
    Route::get('/materi/{materi}/{user}', [MateriSiswaController::class, 'index'])->name('materiSiswa.index')->middleware('auth');
    Route::get('/tugas/{materi}/{user}', [TugasSiswaController::class, 'index'])->name('tugasSiswa.index')->middleware('auth');

    Route::get('/penyelesaian/materi/{user}/{id_materi}', [MateriSiswaController::class, 'selesai'])->name('materi.selesai')->middleware('auth');
    Route::post('/penyelesaian/{user}/tugas/{materi}', [TugasSiswaController::class, 'selesai'])->name('tugas.selesai')->middleware('auth');
    Route::post('/penyelesaian/kuis/{kuis}', [KuisSiswaController::class, 'selesai'])->name('kuis.selesai')->middleware('auth');
    Route::patch('/profil/{user}/edit', [profilController::class, 'updateProfil'])->name('profil.update')->middleware('auth');
});


//SuperAdmin
Route::group(['middleware' => ['hak_aksesAdmin']], function (){
Route::get('/berandaSuperAdmin', [superAdminController::class, 'index'])->name('superAdmin.index')->middleware('auth');
Route::get('/panduan/superAdmin', [superAdminController::class, 'panduan'])->name('superAdmin.panduan')->middleware('auth');
Route::post('/panduan/superAdmin',[superAdminController::class, 'ganti'])->name('superAdmin.panduan.ganti')->middleware('auth');
//-----------------------MenuDaftarSiswa---------------------------------
Route::get('/daftarSiswa',[DaftarSiswaController::class, 'index'])->name('siswa.index')->middleware('auth');
Route::post('/daftarSiswa',[DaftarSiswaController::class, 'store'])->middleware('auth');
Route::get('/daftarSiswa/{user}/edit',[DaftarSiswaController::class, 'edit'])->name('siswa.edit')->middleware('auth');
Route::patch('/daftarSiswa/{user}',[DaftarSiswaController::class, 'update'])->name('siswa.update')->middleware('auth');
Route::get('/daftarSiswa/{user}/hapus',[DaftarSiswaController::class, 'destroy'])->name('siswa.delete')->middleware('auth');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/back', [ProfilController::class, 'kembali'])->name('kembali')->middleware('auth');

//profile


