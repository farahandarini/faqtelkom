<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserEksternalController;
use App\Http\Controllers\UserInternalController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// --------------------------- USER EKSTERNAL ---------------------------
// halaman utama
Route::get('/', [UserEksternalController::class, 'index']); // tampil pertanyaan yg sering ditanyakan & kategori
Route::get('/ajax',[UserEksternalController::class, 'ajax']); // mencari pertanyaan

// halaman contact us
// Route::get('/contactus', function () {
//     return view('usereksternal.contactus');
// });
Route::get('/contactus', [UserEksternalController::class, 'contact']);

// halaman kategori
// Route::get('/kategori', function () {
//     return view('usereksternal.kategori'); // pertanyaan sesuai kategori
// });
Route::get('/kategori/{id}', [UserEksternalController::class, 'detailkat']); // judul pd navbar, pertanyaan sesuai kategori, judul kategori
Route::get('/kategori/{id}/get_pertanyaan',[UserEksternalController::class, 'get_pertanyaan']); // mencari pertanyaan

// halaman login
Route::get('/login', function () {
    return view('login');
});

// Route::get('ambil_p',[AdminController::class, 'ajax1'])->name('ambil_p'); // search

Route::middleware(['middleware'=> 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// --------------------------- ADMIN ---------------------------
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']], function(){

    // halaman utama
    Route::get('index',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('ambil_p',[AdminController::class, 'ambil_p'])->name('ambil_p'); // search

    /////// PERTANYAAN
    Route::get('hapus_p{id}', [AdminController::class, 'hapus_p']); // hapus pertanyaan

    Route::get('edit_p{id}', [AdminController::class, 'edit_p']); // ke halaman edit
    Route::patch('edit_p/edit_tanyaindex{id}', [AdminController::class, 'edit_tanyaindex']); // proses edit pertanyaan

    Route::get('add_p', [AdminController::class, 'add_p']); // ke halaman tambah
    Route::post('add_p/add_tanyaindex', [AdminController::class, 'add_tanyaindex']); // proses simpan pertanyaan

    Route::post('upload', [AdminController::class, 'upload']);

    /////// kategori
    Route::get('hapus_k{id}', [AdminController::class, 'hapus_k']); // hapus kategori
    Route::patch('edit_k{id}', [AdminController::class, 'edit_k']); // proses edit kategori
    Route::post('add_k', [AdminController::class, 'add_k']); // proses add kategori

    // halaman contact us
    Route::get('contactus', [AdminController::class, 'contact']);

    // halaman kategori
    Route::get('kategori{id}', [AdminController::class, 'detailkat'])->name('admin.kategori'); // judul pd navbar, pertanyaan sesuai kategori, judul kategori
    Route::get('get_pertanyaan', [AdminController::class, 'get_pertanyaan']); // mencari pertanyaan
   
    Route::get('add_p2_{id}', [AdminController::class, 'add_p2']); // ke halaman add_p2
    Route::post('add_p2/add_tanyakategori', [AdminController::class, 'add_tanyakategori']); // proses simpan pertanyaan

    Route::get('delete/hapus_p2_{id}', [AdminController::class, 'hapus_p2']); // hapus pertanyaan

    Route::get('ubah_per2_{id}', [AdminController::class, 'edit_p2']); // ke halaman edit
    Route::patch('edit/edit_tanyakategori{id}', [AdminController::class, 'edit_tanyakategori']); // proses edit pertanyaan

});


// --------------------------- USER INTERNAL ---------------------------
Route::group(['prefix'=>'userinternal', 'middleware'=>['isUserInternal','auth','PreventBackHistory']], function(){

    // halaman utama
    Route::get('index',[UserInternalController::class,'index'])->name('userinternal.dashboard');
    Route::get('ajax',[UserInternalController::class, 'ajax']); // search

    // halaman contact us
    Route::get('contactus', [UserInternalController::class, 'contact']);

    // halaman add pertanyaan
    Route::get('addpertanyaan', [UserInternalController::class, 'addpertanyaan']);
    Route::post('add', [UserInternalController::class, 'addpertanyaanprocess']); // save jawaban

    // halaman edit pertanyaan
    Route::get('editpertanyaan{id}', [UserInternalController::class, 'editpertanyaan']);
    Route::patch('edit_{id}', [UserInternalController::class, 'editpertanyaanprocess']);

    // hapus pertanyaan
    Route::get('hapuspertanyaan{id}', [UserInternalController::class, 'hapuspertanyaan']);

    // halaman kategori
    Route::get('kategori{id}', [UserInternalController::class, 'detailkat'])->name('userinternal.kategori'); // judul pd navbar, pertanyaan sesuai kategori, judul kategori
    Route::get('get_pertanyaan', [UserInternalController::class, 'get_pertanyaan']); // mencari pertanyaan

    Route::get('edit_pertanyaan{id}', [UserInternalController::class, 'edit_pertanyaan']); // edit
    Route::patch('edit/edit_proses{id}', [UserInternalController::class, 'edit_proses']);

    Route::get('hapus_pertanyaan{id}', [UserInternalController::class, 'hapus_pertanyaan']); // hapus

    Route::get('add_pertanyaan{id}', [UserInternalController::class, 'add_pertanyaan']); // tambah
    Route::post('add_process', [UserInternalController::class, 'add_pertanyaanprocess']);

    Route::post('upload', [UserInternalController::class, 'upload']);

});