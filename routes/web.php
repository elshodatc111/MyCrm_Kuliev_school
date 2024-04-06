<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\KabinetController;
use App\Http\Controllers\SuperAdmin\HodimlarController;
use App\Http\Controllers\SuperAdmin\FilialController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Techer\TecherController;
use App\Http\Controllers\User\UserController;

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

### Start SuperAdmin ###
Route::get('/Superadmin/index', [SuperAdminController::class, 'index'])->name('SuperAdmin');
Route::get('/Superadmin/hisobot', [SuperAdminController::class, 'hisobot'])->name('hisobot');
Route::get('/Superadmin/statistika', [SuperAdminController::class, 'statistika'])->name('statistika');
    ###Filiallar###
Route::get('/Superadmin/filial', [FilialController::class, 'filial'])->name('filial');
Route::get('/Superadmin/filial/show/{id}', [FilialController::class, 'show'])->name('filial.show');
Route::get('/Superadmin/filailCrm/{id}', [FilialController::class, 'filailCrm'])->name('filailCrm');
Route::get('/Superadmin/room/delete/{id}', [FilialController::class, 'roomdelete'])->name('roomdelete');
Route::get('/Superadmin/setting/tulov/deleted/{id}', [FilialController::class, 'tulovSettingDelete'])->name('tulovSettingDelete');
Route::post('/Superadmin/setting/tulov/create', [FilialController::class, 'tulovSettingCreate'])->name('tulovSettingCreate');
Route::post('/Superadmin/room/create', [FilialController::class, 'roomcreate'])->name('roomcreate');
Route::post('/Superadmin/filial', [FilialController::class, 'filialcreate'])->name('filialcreate');
    ###Hodimlar###
Route::get('/Superadmin/hodimlar', [HodimlarController::class, 'hodimlar'])->name('hodimlar');
Route::post('/Superadmin/hodimlar', [HodimlarController::class, 'hodimCreate'])->name('hodimCreate');
Route::get('/Superadmin/del/{id}', [HodimlarController::class, 'HodimDeletes'])->name('HodimDeletes');
Route::get('/Superadmin/pass/{id}', [HodimlarController::class, 'HodimPassword'])->name('HodimPassword');
    ###Kabinet###
Route::get('/Superadmin/kabinet', [KabinetController::class, 'kabinet'])->name('kabinet');
Route::put('/Superadmin/kabinet/{id}', [KabinetController::class, 'kabinetUpdate'])->name('kabinetUpdate');
Route::put('/Superadmin/kabinet/password/{id}', [KabinetController::class, 'kabinetPassword'])->name('kabinetPassword');
### Emd SuperAdmin ###
### Admin ###
Route::get('/Admin/index', [AdminController::class, 'index'])->name('Admin');

### Techer ###
Route::get('/Techer/index', [TecherController::class, 'index'])->name('Techer');
Route::get('/Techer/guruhlar', [TecherController::class, 'Guruhlar'])->name('TGuruhlar');
Route::get('/Techer/tulovlar', [TecherController::class, 'Tolovlar'])->name('TTolovlar');
Route::get('/Techer/kabinet', [TecherController::class, 'Kabinet'])->name('TKabinet');

### User ###
Route::get('/User/index', [UserController::class, 'index'])->name('User');
Route::get('/User/guruhlar', [UserController::class, 'Guruhlar'])->name('Guruhlar');
Route::get('/User/tolovlar', [UserController::class, 'Tolovlar'])->name('Tolovlar');
Route::get('/User/contact', [UserController::class, 'Contact'])->name('Contact');
Route::get('/User/kabinet', [UserController::class, 'Kabinet'])->name('Kabinet');