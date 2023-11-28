<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PriorityLevelController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SubscriptionModelController;
use App\Http\Controllers\TagController;
use App\Models\SubscriptionModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use Modules\Ynotz\EasyAdmin\Services\RouteHelper;
use Modules\Ynotz\AppSettings\Http\Controllers\AppSettingsController;

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
    return view('welcome');
});
Route::get('/clientRegistration',function(){
    return view('client_registration');
})->name('client.register');

Route::post('/clientRegistration',[ClientController::class,'regsiteringNewClient'])->name('register.newClient');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    RouteHelper::getEasyRoutes(
        modelName: 'AppSetting',
        controller: AppSettingsController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'SubscriptionModel',
        controller: SubscriptionModelController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'Stage',
        controller: StageController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'Segment',
        controller: SegmentController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'Tag',
        controller: TagController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'Source',
        controller: SourceController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'Client',
        controller: ClientController::class
    );
    RouteHelper::getEasyRoutes(
        modelName:'Branch',
        controller:BranchController ::class
    );

    RouteHelper::getEasyRoutes(
        modelName:'Lead',
        controller:LeadController ::class
    );
   
    RouteHelper::getEasyRoutes(
        modelName:'Followup',
        controller:FollowupController::class
    );

    RouteHelper::getEasyRoutes(
        modelName:'PriorityLevel',
        controller:PriorityLevelController::class
    );

    Route::get('/roles-permissions', [RoleController::class, 'rolesPermissions'])->name('roles.permissions');
    Route::post('/roles/permission-update', [RoleController::class, 'permissionUpdate'])->name('roles.update_permissions');
});

require __DIR__.'/auth.php';
