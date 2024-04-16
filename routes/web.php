<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\KabinetController;
use App\Http\Controllers\SuperAdmin\HodimlarController;
use App\Http\Controllers\SuperAdmin\FilialController;
use App\Http\Controllers\SuperAdmin\SuperMoliyaController;
use App\Http\Controllers\SuperAdmin\SuperReportController;
use App\Http\Controllers\SuperAdmin\SuperStatistikaController;
use App\Http\Controllers\SuperAdmin\SuperElonController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HodimController;
use App\Http\Controllers\Admin\AdminGuruhController;
use App\Http\Controllers\Admin\AdminTecherController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminKabinetController;
use App\Http\Controllers\Admin\MoliyaController;
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
Route::post('/Superadmin/filial/update', [FilialController::class, 'filialUpdate'])->name('filialUpdate');
Route::post('/Superadmin/filial/delete', [FilialController::class, 'filialDelete'])->name('filialDelete');
Route::get('/Superadmin/filailCrm/{id}', [FilialController::class, 'filailCrm'])->name('filailCrm');

Route::get('/Superadmin/moliya/{id}', [SuperMoliyaController::class, 'index'])->name('SuperAdminMoliya');

Route::get('/Superadmin/statistika/{id}', [SuperStatistikaController::class, 'index'])->name('SuperAdminStatistika');

Route::get('/Superadmin/report/{id}', [SuperReportController::class, 'index'])->name('SuperAdminReport');

Route::get('/Superadmin/elon/techer', [SuperElonController::class, 'techer'])->name('SuperAdminElonTecher');
Route::get('/Superadmin/elon/student', [SuperElonController::class, 'student'])->name('SuperAdminElonStudent');

Route::get('/Superadmin/room/delete/{id}', [FilialController::class, 'roomdelete'])->name('roomdelete');
Route::get('/Superadmin/setting/tulov/deleted/{id}', [FilialController::class, 'tulovSettingDelete'])->name('tulovSettingDelete');
Route::post('/Superadmin/setting/tulov/create', [FilialController::class, 'tulovSettingCreate'])->name('tulovSettingCreate');
Route::post('/Superadmin/room/create', [FilialController::class, 'roomcreate'])->name('roomcreate');
Route::post('/Superadmin/filial', [FilialController::class, 'filialcreate'])->name('filialcreate');
Route::post('/Superadmin/cours/create', [FilialController::class, 'filialCoursCreate'])->name('filialCoursCreate');
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
Route::get('/Admin/eslatma', [AdminController::class, 'eslatmalar'])->name('AdminEslatma');
Route::get('/Admin/eslatma/arxiv/{id}', [AdminController::class, 'eslatmaarxiv'])->name('AdminEslatmaArxiv');
Route::get('/Admin/murojatlar', [AdminController::class, 'murojatlar'])->name('AdminMurojarlar');
Route::get('/Admin/tkun', [AdminController::class, 'tkun'])->name('AdminTKun');
Route::get('/Admin/elonlar', [AdminController::class, 'elonlar'])->name('AdminElonlar');

Route::get('/Admin/student/index', [AdminStudentController::class, 'index'])->name('Student');
Route::get('/Admin/student/index/{id}', [AdminStudentController::class, 'show'])->name('StudentShow');
Route::get('/Admin/student/debit', [AdminStudentController::class, 'debit'])->name('StudentQarzdorlar');
Route::get('/Admin/student/pays', [AdminStudentController::class, 'pays'])->name('StudentTulovlar');
Route::get('/Admin/student/create', [AdminStudentController::class, 'create'])->name('StudentCreate');
Route::post('/Admin/student/story', [AdminStudentController::class, 'store'])->name('StudentCreateStore');
Route::post('/Admin/student/update', [AdminStudentController::class, 'update'])->name('AdminUserUpdate');
Route::post('/Admin/student/password/update', [AdminStudentController::class, 'passwordUpdate'])->name('AdminUserPasswordUpdate');
Route::post('/Admin/student/guruh/plus', [AdminStudentController::class, 'guruhPlus'])->name('AdminUserGuruhPlus');
Route::post('/Admin/student/send/messege', [AdminStudentController::class, 'sendMessege'])->name('AdminUserSendMessege');
Route::post('/Admin/student/pay', [AdminStudentController::class, 'tulov'])->name('AdminUserTulov');
Route::post('/Admin/student/pay/qaytar', [AdminStudentController::class, 'tulovQaytar'])->name('AdminUserTulovQaytar');
Route::post('/Admin/student/admin/chegirma', [AdminStudentController::class, 'adminChegirmaMax'])->name('AdminUserAdminChegirma');
Route::post('/Admin/student/comment', [AdminStudentController::class, 'comment'])->name('AdminUserComment');
Route::get('/Admin/student/pay/delete/{id}', [AdminStudentController::class, 'tulovDelete'])->name('AdminUserTulovDelete');

Route::get('/Admin/moliya', [MoliyaController::class, 'index'])->name('AdminMoliya');
Route::post('/Admin/moliya/chiqim', [MoliyaController::class, 'chiqim'])->name('AdminMoliyaCHiqim');
Route::post('/Admin/moliya/chiqim/delete', [MoliyaController::class, 'chiqimdelete'])->name('AdminMoliyaCHiqimDelete');
Route::post('/Admin/moliya/chiqim/tasdiqlandi', [MoliyaController::class, 'chiqimtasdiq'])->name('AdminMoliyaCHiqimTasdiq');
Route::post('/Admin/moliya/xarajat', [MoliyaController::class, 'xarajat'])->name('AdminMoliyaXarajat');
Route::post('/Admin/moliya/xarajat/delete', [MoliyaController::class, 'xarajatdelete'])->name('AdminMoliyaXarajatDelete');
Route::post('/Admin/moliya/xarajat/tasdiqlandi', [MoliyaController::class, 'xarajattasdiq'])->name('AdminMoliyaXarajatTasdiq');

Route::get('/Admin/guruh', [AdminGuruhController::class, 'index'])->name('AdminGuruh');
Route::get('/Admin/guruh/show/{id}', [AdminGuruhController::class, 'show'])->name('AdminGuruhShow');
Route::get('/Admin/guruh/end', [AdminGuruhController::class, 'endGuruh'])->name('AdminGuruhEnd');
Route::get('/Admin/guruh/create', [AdminGuruhController::class, 'CreateGuruh'])->name('AdminGuruhCreate');
Route::post('/Admin/guruh/create1', [AdminGuruhController::class, 'CreateGuruh1'])->name('AdminGuruhCreate1');
Route::post('/Admin/guruh/create2', [AdminGuruhController::class, 'CreateGuruh2'])->name('AdminGuruhCreate2');
Route::put('/Admin/guruh/create/next', [AdminGuruhController::class, 'CreateGuruhNext'])->name('CreateGuruhNext');
Route::post('/Admin/guruh/create/next2', [AdminGuruhController::class, 'CreateGuruhNext2'])->name('CreateGuruhNext2');
Route::post('/Admin/guruh/deleteUser', [AdminGuruhController::class, 'guruhDelUser'])->name('guruhDeletesUserss');
Route::post('/Admin/guruh/user/sendMessege', [AdminGuruhController::class, 'userSendMessege'])->name('userSendMessege');
Route::post('/Admin/guruh/debit/sendMessege', [AdminGuruhController::class, 'debitSendMessege'])->name('debitSendMessege');

Route::get('/Admin/admin/techer', [AdminTecherController::class, 'index'])->name('AdminTecher');
Route::post('/Admin/admin/techer', [AdminTecherController::class, 'techerCreate'])->name('AdminTecherCreate');
Route::post('/Admin/admin/techer/update', [AdminTecherController::class, 'techerUpdate'])->name('AdminTecherUpdate');
Route::post('/Admin/admin/techer/pay', [AdminTecherController::class, 'TecherPay'])->name('AdminTecherPay');
Route::post('/Admin/admin/techer/update/password', [AdminTecherController::class, 'techerUpdatePassword'])->name('AdminTecherUpdatePassword');
Route::get('/Admin/admin/techer/show/{id}', [AdminTecherController::class, 'techerShow'])->name('AdminTecherShow');
Route::get('/Admin/admin/techer/delete/{id}', [AdminTecherController::class, 'techerDelete'])->name('AdminTecherDelete');

Route::get('/Admin/hodim/kabinet', [AdminKabinetController::class, 'kabinet'])->name('adminkabinet');
Route::post('/Admin/hodim/kabinet/update', [AdminKabinetController::class, 'update'])->name('adminkabinetupdate');
Route::post('/Admin/hodim/kabinet/passwupdate', [AdminKabinetController::class, 'passwupdate'])->name('adminkabinetpasswupdate');

Route::get('/Admin/hodim/', [HodimController::class, 'adminHodimlar'])->name('adminHodimlar');
Route::get('/Admin/hodim/{id}', [HodimController::class, 'adminHodim'])->name('adminHodim');
Route::get('/Admin/hodim/delete/{id}', [HodimController::class, 'adminHodimDelete'])->name('adminHodimDelete');
Route::post('/Admin/hodim/create', [HodimController::class, 'adminCreateHodimlar'])->name('adminCreateHodimlar');
Route::post('/Admin/hodim/clear/statistika', [HodimController::class, 'adminClearHodimlarStatistik'])->name('adminClearHodimlarStatistik');
Route::post('/Admin/hodim/update/user', [HodimController::class, 'adminUpdateHodimlarUser'])->name('adminUpdateHodimlarUser');
Route::post('/Admin/hodim/update/password', [HodimController::class, 'adminUpdateHodimlarPassword'])->name('adminUpdateHodimlarPassword');
Route::post('/Admin/hodim/pay/ishhaqi', [HodimController::class, 'adminPayHodimlarIshHaqi'])->name('adminPayHodimlarIshHaqi');
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