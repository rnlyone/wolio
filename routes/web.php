<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UserController;
use App\Models\Setting;
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

Route::group(['middleware'=>['guest']], function(){
    Route::get('/login', [UserController::class, 'flogin'])->name('flogin');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    // Route::get('/register', [UserController::class, 'fregister'])->name('fregister');
    // Route::post('/register', [UserController::class, 'register'])->name('register');

    Route::fallback(function () {
        return redirect()->route('flogin')->with('gagal', 'Anda harus login terlebih dahulu');
    });
});

Route::group(['middleware'=>['auth']], function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::resource('/user', UserController::class);
    Route::get('/user-manage', [UserController::class, 'user_manage'])->name('user.manage');


    Route::resource('/kelas', KelasController::class);

    Route::resource('/materi', MateriController::class);
    Route::get('/materi-manage', [MateriController::class, 'manage'])->name('materi.manage');
    Route::get('/materi-search', [MateriController::class, 'search'])->name('materi.search');
    Route::get('/materi-kategori', [MateriController::class, 'showkategori'])->name('materi.kategori');
    Route::post('/addaudio/{materi}', [MateriController::class, 'addAudio'])->name('materi.add.audio');

    Route::resource('/kategori', KategoriController::class);
    Route::get('/kategori-manage', [KategoriController::class, 'manage'])->name('kategori.manage');

    Route::resource('/kuis', KuisController::class);
    Route::get('/kuis-manage', [KuisController::class, 'manage'])->name('kuis.manage');
    Route::get('/kuis-kategori', [KuisController::class, 'showkategori'])->name('kuis.kategori');
    Route::get('/play', [KuisController::class, 'play'])->name('kuis.play');
    Route::post('/ambilsoal', [KuisController::class, 'ambilSoal'])->name('kuis.ambilsoal');
    Route::post('/kirim', [KuisController::class, 'kirim'])->name('kuis.kirim');
    Route::post('/addaudio/{materi}', [MateriController::class, 'addAudio'])->name('materi.add.audio');

    Route::resource('/soal', SoalController::class);
    Route::post('/addaudiosoal/{soal}', [SoalController::class, 'addAudio'])->name('soal.add.audio');
    Route::post('/addjawaban/{soal}', [SoalController::class, 'addJawaban'])->name('soal.add.jawaban');
    Route::post('/updatejawaban/{soal}', [SoalController::class, 'updateJawaban'])->name('soal.update.jawaban');

    Route::resource('/riwayat', RiwayatController::class);
    Route::resource('/jawaban', JawabanController::class);
    Route::resource('/setting', SettingController::class);
    Route::resource('/audio', AudioController::class);

    Route::get('/', function () {
        $customcss = '';
            $jmlsetting = Setting::where('group', 'env')->get();
            $settings = ['title' => ': List User',
                         'customcss' => $customcss,
                         'pagetitle' => 'List User',
                         'subtitle' => 'List User',
                         'navactive' => 'homenav',
                         'baractive' => 'homebar',];
                        foreach ($jmlsetting as $i => $set) {
                            $settings[$set->setname] = $set->value;}
        return view('welcome', [
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    })->name('welcome');
});


