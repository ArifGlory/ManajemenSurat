<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Back\JenisPenandatanganController;
use App\Http\Controllers\Back\KodeQRController;
use App\Http\Controllers\Back\LogsController;
use App\Http\Controllers\Back\PenggunaController;
use App\Http\Controllers\Back\PerangkatDaerahController;
use App\Http\Controllers\Back\SettingsController;
use App\Http\Controllers\Back\SignatureQRController;
use App\Http\Controllers\Back\SuratMasukController;
use App\Http\Controllers\Back\DisposisiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


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

//Route::get('/', function () {
//    //return view('welcome');
//});
/*Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});*/
/*Route::get('sysmlink', function(){
    $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/qrcodeLaravel/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/qrcodeLaravel/file-storage';
//    dd($targetFolder, $linkFolder);
    symlink($targetFolder, $linkFolder);
    return 'success';
});*/

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('detail-surat-keluar/{id}', [KodeQRController::class, 'show']);
Route::get('surat-masuk/{id}', [SuratMasukController::class, 'show']);
Route::get('show-disposisi/{id}', [SuratMasukController::class, 'dataDisposisiShow']);
Route::get('signature-qr/{id}', [SignatureQRController::class, 'show']);
Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'logs', 'middleware' => ['adminsuper']], function () {
        Route::get('/', [LogsController::class, 'index'])->name('logs');
        Route::get('data', [LogsController::class, 'data'])->name('logs.data');
        Route::delete('delete/{id}', [LogsController::class, 'destroy']);
        Route::post('bulkDelete', [LogsController::class, 'bulkDelete']);
    });

    Route::group(['prefix' => 'pengguna', 'middleware' => ['adminsuper']], function () {
        Route::get('/', [PenggunaController::class, 'index'])->name('pengguna');
        Route::get('data', [PenggunaController::class, 'data']);
        Route::delete('delete/{id}', [PenggunaController::class, 'destroy']);
        Route::post('bulkDelete', [PenggunaController::class, 'bulkDelete']);
        Route::get('form', [PenggunaController::class, 'form'])->name('pengguna.form');
        Route::post('create', [PenggunaController::class, 'create']);
        Route::get('edit/{id}', [PenggunaController::class, 'edit']);
        Route::put('update/{id}', [PenggunaController::class, 'update']);
        Route::get('show/{id}', [PenggunaController::class, 'show']);
    });

    Route::group(['prefix' => 'jenis-penandatangan', 'middleware' => ['adminsuper']], function () {
        Route::get('/', [JenisPenandatanganController::class, 'index'])->name('jenis-penandatangan');
        Route::get('data', [JenisPenandatanganController::class, 'data'])->name('jenis-penandatangan.data');;
        Route::delete('delete/{id}', [JenisPenandatanganController::class, 'destroy']);
        Route::post('bulkDelete', [JenisPenandatanganController::class, 'bulkDelete']);
        Route::post('create', [JenisPenandatanganController::class, 'create']);
        Route::get('edit/{id}', [JenisPenandatanganController::class, 'edit']);
        Route::put('update/{id}', [JenisPenandatanganController::class, 'update']);
    });

    Route::group(['prefix' => 'perangkat-daerah', 'middleware' => ['adminsuper']], function () {
        Route::get('/', [PerangkatDaerahController::class, 'index'])->name('perangkat-daerah');
        Route::get('data', [PerangkatDaerahController::class, 'data'])->name('perangkat-daerah.data');;
        Route::get('form', [PerangkatDaerahController::class, 'form'])->name('perangkat-daerah.form');;
        Route::delete('delete/{id}', [PerangkatDaerahController::class, 'destroy']);
        Route::post('bulkDelete', [PerangkatDaerahController::class, 'bulkDelete']);
        Route::post('create', [PerangkatDaerahController::class, 'create']);
        Route::get('edit/{id}', [PerangkatDaerahController::class, 'edit']);
        Route::get('show/{id}', [PerangkatDaerahController::class, 'show']);
        Route::put('update/{id}', [PerangkatDaerahController::class, 'update']);
    });

    Route::group(['prefix' => 'surat-keluar', 'middleware' => ['seluruhlevel']], function () {
        Route::get('/', [KodeQRController::class, 'index'])->name('surat-keluar');
        Route::get('data', [KodeQRController::class, 'data'])->name('surat-keluar.data');
        Route::delete('delete/{id}', [KodeQRController::class, 'destroy']);
        Route::post('bulkDelete', [KodeQRController::class, 'bulkDelete']);
        Route::get('form', [KodeQRController::class, 'form'])->name('surat-keluar.form');
        Route::post('create', [KodeQRController::class, 'create']);
        Route::get('edit/{id}', [KodeQRController::class, 'edit']);
        Route::get('print/{id}', [KodeQRController::class, 'print']);
        Route::put('update/{id}', [KodeQRController::class, 'update']);
        Route::get('statistik-tanda-tangan', [KodeQRController::class, 'statistik_tanda_tangan']);
        Route::get('grafik-statistik-tanda-tangan', [KodeQRController::class, 'tampil_grafik_ttd']);
    });

    Route::group(['prefix' => 'signature-qr', 'middleware' => ['adminsuper']], function () {
        Route::get('/', [SignatureQRController::class, 'index'])->name('signature-qr');
        Route::get('data', [SignatureQRController::class, 'data']);
        Route::delete('delete/{id}', [SignatureQRController::class, 'destroy']);
        Route::post('bulkDelete', [SignatureQRController::class, 'bulkDelete']);
        Route::get('form', [SignatureQRController::class, 'form'])->name('signature-qr.form');
        Route::post('create', [SignatureQRController::class, 'create']);
        Route::get('edit/{id}', [SignatureQRController::class, 'edit']);
        Route::get('print/{id}', [SignatureQRController::class, 'print']);
        Route::put('update/{id}', [SignatureQRController::class, 'update']);
        Route::get('select2-surat-keluar', [SignatureQRController::class, 'dataAjaxSuratKeluar']);
        Route::get('fetch-surat-keluar', [SignatureQRController::class, 'fetchSuratKeluar']);
    });

    Route::group(['prefix' => 'statistik', 'middleware' => ['adminsuper']], function () {
        Route::get('tanda-tangan', [KodeQRController::class, 'statistik_tanda_tangan']);
        Route::get('grafik-tanda-tangan', [KodeQRController::class, 'tampil_grafik_ttd']);
        Route::get('perangkat-daerah', [KodeQRController::class, 'statistik_perangkat_daerah']);
        Route::get('grafik-perangkat-daerah', [KodeQRController::class, 'tampil_grafik_pd']);
        Route::get('signature-opd', [SignatureQRController::class, 'statistik_perangkat_daerah']);
        Route::get('grafik-signature-opd', [SignatureQRController::class, 'tampil_grafik_pd']);
    });

    Route::group(['prefix' => 'surat-masuk', 'middleware' => ['seluruhlevel']], function () {
        Route::get('/', [SuratMasukController::class, 'index'])->name('surat-masuk');
        Route::get('data', [SuratMasukController::class, 'data'])->name('surat-masuk.data');
        Route::delete('delete/{id}', [SuratMasukController::class, 'destroy'])->middleware('superumum');
        Route::post('bulkDelete', [SuratMasukController::class, 'bulkDelete'])->middleware('superumum');
        Route::get('form', [SuratMasukController::class, 'form'])->name('surat-masuk.form')->middleware('superumum');
        Route::post('create', [SuratMasukController::class, 'create'])->middleware('superumum');
        Route::get('edit/{id}', [SuratMasukController::class, 'edit'])->middleware('superumum');
        Route::get('print/{id}', [SuratMasukController::class, 'print']);
        Route::put('update/{id}', [SuratMasukController::class, 'update'])->middleware('superumum');
    });

    Route::group(['prefix' => 'disposisi', 'middleware' => ['seluruhlevel']], function () {
        Route::get('/{id}', [SuratMasukController::class, 'disposisi']);
        Route::get('data/{id}', [SuratMasukController::class, 'dataDisposisi']);

        Route::delete('delete/{id}', [DisposisiController::class, 'destroy']);
        Route::post('create', [DisposisiController::class, 'create']);
        Route::get('edit/{id}', [DisposisiController::class, 'edit']);
        Route::put('update/{id}', [DisposisiController::class, 'update']);
        Route::get('get-dari/{id}', [DisposisiController::class, 'getdari']);
    });

    Route::group(['prefix' => 'disposisi-surat-keluar', 'middleware' => ['seluruhlevel']], function () {
        Route::get('/{id}', [KodeQRController::class, 'disposisi']);
        Route::get('data/{id}', [KodeQRController::class, 'dataDisposisi']);

        Route::delete('delete/{id}', [DisposisiController::class, 'destroy']);
        Route::post('create', [DisposisiController::class, 'create']);
        Route::get('edit/{id}', [DisposisiController::class, 'edit']);
        Route::put('update/{id}', [DisposisiController::class, 'update']);
        Route::get('get-dari/{id}', [DisposisiController::class, 'getdari']);
    });


    Route::get('profil', [PenggunaController::class, 'profil'])->name('profil');
    Route::get('side-profil', [PenggunaController::class, 'sideProfil']);
    Route::put('update-profil', [PenggunaController::class, 'updateProfil']);
    Route::get('ubah-password', [PenggunaController::class, 'ubahPassword'])->name('ubah-password');
    Route::put('update-password', [PenggunaController::class, 'updatePassword']);
    Route::get('settings', [SettingsController::class, 'index'])->name('settings')->middleware('adminsuper');
    Route::put('update-settings', [SettingsController::class, 'updateAll'])->middleware('adminsuper');
    Route::get('my-logs', [LogsController::class, 'logsPengguna'])->name('my-logs');
    Route::get('data-logs', [LogsController::class, 'logsData']);
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'adminsuper']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

//Route::get('/jenisbantuan', [JenisBantuanController::class, 'index'])
//    ->middleware(['auth'])->name('jenisbantuan');

require __DIR__ . '/auth.php';
