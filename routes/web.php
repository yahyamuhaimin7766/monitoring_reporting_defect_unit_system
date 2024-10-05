<?php

use App\Http\Controllers\{
    ProfileController,
    UserController,
    DefectController,
    DefectLeaderController,
    MainController,
    PemasanganController,
    DashboardController,
    RepairController,
    RepairLeaderController,
    LaporanController
};
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class,'index'])
->middleware(['auth', 'verified'])
->name('dashboard');
Route::post('/data', [DashboardController::class,'getData'])
->middleware(['auth', 'verified'])
->name('getData');

Route::post('/data-leader', [DashboardController::class,'getDataLeader'])
->middleware(['auth', 'verified'])
->name('getData');



Route::middleware(['role:admin'])->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('/', [userController::class, 'index'])->name('user.index');
        Route::match(['get','put'], '/create', [UserController::class, 'create'])->name('user.create');
        Route::match(['get', 'patch'],'/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    });
    Route::prefix('pemasangan')->group(function(){
        Route::get('/', [PemasanganController::class, 'index'])->name('pemasangan.index');
        Route::match(['get','put'], '/create', [PemasanganController::class, 'create'])->name('pemasangan.create');
        Route::match(['get', 'patch'],'/{id}/edit', [PemasanganController::class, 'edit'])->name('pemasangan.edit');
        Route::get('/{id}/view', [PemasanganController::class, 'view'])->name('pemasangan.view');
        Route::delete('/{id}/delete', [PemasanganController::class, 'destroy'])->name('pemasangan.destroy');
        Route::get('/cetak', [PemasanganController::class, 'cetak'])->name('pemasangan.cetak');
        Route::get('/getcetak', [PemasanganController::class, 'getcetak'])->name('pemasangan.cetakget');
    });
});

Route::middleware(['role:qc'])->group(function () {
    Route::prefix('qc')->group(function() {
        Route::get('/', [DefectController::class, 'index'])->name('defect.index');
        Route::match(['get','put'], '/create', [DefectController::class, 'create'])->name('defect.create');
        Route::match(['get', 'patch'],'/{id}/edit', [DefectController::class, 'edit'])->name('defect.edit');
        Route::get('/{id}/view', [DefectController::class, 'view'])->name('defect.view');
        Route::delete('/{id}/delete', [DefectController::class, 'destroy'])->name('defect.destroy');
        Route::post('/fetch-pemasangan', [DefectController::class, 'fetchData']);
        Route::get('/cetak', [DefectController::class, 'cetak'])->name('defect.cetak');
        Route::get('/getcetak', [DefectController::class, 'getcetak'])->name('defect.cetakget');
    });
});

Route::middleware(['role:leader'])->group(function () {
    
});

Route::middleware(['role:maintenance'])->group(function () {
   Route::prefix('maintenance')->group(function(){
        Route::get('/', [RepairController::class, 'index'])->name('repair.index');
        Route::match(['get', 'put'], '/create', [RepairController::class, 'create'])->name('repair.create');
        Route::match(['get', 'patch'], '/{id}/edit', [RepairController::class, 'edit'])->name('repair.edit');
        Route::get('/{id}/view', [RepairController::class, 'view'])->name('repair.view');
        Route::delete('/{id}/delete', [RepairController::class, 'destroy'])->name('repair.destroy');
        Route::post('/fetch-defect', [RepairController::class, 'fetchData']);
        Route::get('/cetak', [RepairController::class, 'cetak'])->name('repair.cetak');
        Route::get('/getcetak', [RepairController::class, 'getcetak'])->name('repair.cetakget');
   });
});
Route::middleware(['role:leader'])->group(function () {
    Route::prefix('leader')->group(function(){
        Route::get('/repair', [RepairleaderController::class, 'index'])->name('repair.leader.index');
        Route::get('/repair/{id}/view', [RepairleaderController::class, 'view'])->name('repair.leader.view');
        Route::get('/defect', [DefectleaderController::class, 'index'])->name('defect.leader.index');
        Route::get('/defect/{id}/view', [DefectleaderController::class, 'view'])->name('defect.leader.view');
        Route::get('/cetak', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('/laporan', [LaporanController::class,'cetak'])->name('laporan.cetak');
    
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('generate-json/select2', [MainController::class, 'select2Response'])->name('generate.json.select2');

require __DIR__.'/auth.php';
