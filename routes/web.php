<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ShareLinkController;
use App\Http\Controllers\ActivityLogController;

Auth::routes(['register' => false]);

$statusFile = storage_path('app/public/installed_status.json');

// Check if file exists
if (file_exists($statusFile)) {
    $content = file_get_contents($statusFile);
    $data = json_decode($content, true);
    if (isset($data['installed']) && $data['installed'] === false) {
        require base_path('routes/install.php');
        return;
    }

} else {
   require base_path('routes/install.php');
   return;
}

Route::middleware(['auth', 'verified', 'check_installation'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/file-manager/change-password', [HomeController::class, 'change_password'])->name('change_password');
    Route::post('/file-manager/update-change-password', [HomeController::class, 'update_change_password'])->name('update_change_password');
});

Route::middleware(['auth', 'verified', 'check_password_changed', 'check_installation'])->prefix('/file-manager')->group(function () {
    Route::controller(UserController::class)->prefix('/users')->group(function () {
        Route::get('/index', 'index')->name('user.index');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/update/{id}', 'update')->name('user.update');
        Route::post('/delete', 'destroy')->name('user.delete');
        Route::get('/select-list-ajax', 'list_for_select_ajax')->name('user.list_for_select_ajax');

    });
    /*
    |--------------------------------------------------------------------------
    | FILE MANAGER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::controller(FileManagerController::class)->prefix('/file-manager')->group(function () {
        Route::get('/index', 'index')->name('file-manager.index');
        Route::get('/index-by-folder', 'file_index')->name('file-manager.file_index');
        Route::get('/upload', 'uploadPage')->name('file-manager.upload');
        Route::post('/store', 'store')->name('file-manager.store');
        Route::get('/download/{file}', 'download')->name('file-manager.download');
        Route::post('/restore', 'restore')->name('file-manager.restore');
        Route::get('/trash', 'trash')->name('file-manager.trash');
        Route::post('/delete', 'destroy')->name('file-manager.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | FOLDER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::controller(FolderController::class)->prefix('/folders')->group(function () {
        Route::get('/index', 'index')->name('folder.index');
        Route::post('/store', 'store')->name('folder.store');
        Route::get('/edit/{id}', 'edit')->name('folder.edit');
        Route::get('/show/{id}', 'show')->name('folder.show');
        Route::get('/show-files/{id}', 'show_files')->name('folder.show_files');
        Route::post('/update/{folder}', 'update')->name('folder.update');
        Route::post('/delete', 'destroy')->name('folder.delete');
        Route::get('/select-list-ajax', 'list_for_select_ajax')->name('folder.list_for_select_ajax');
    });

    /*
    |--------------------------------------------------------------------------
    | SHARE LINK ROUTES
    |--------------------------------------------------------------------------
    */

    Route::controller(ShareLinkController::class)->prefix('/share-links')->group(function () {
        Route::get('/index', 'index')->name('share-links.index');
        Route::post('/create/{file}', 'store')->name('share-links.store');
        Route::get('/view/{token}', 'view')->name('share-links.view');
        Route::post('/delete/{share}', 'destroy')->name('share-links.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOG ROUTES
    |--------------------------------------------------------------------------
    */
    Route::controller(ActivityLogController::class)->prefix('/activity-logs')->group(function () {
        Route::get('/index', 'index')->name('activity-log.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE PERMISSION ROUTES
    |--------------------------------------------------------------------------
    */
    Route::controller(RoleController::class)->prefix('user-management')->middleware(['auth', 'check_password_changed'])
        ->group( function($route){
            $route->get('role-assign-to-users', 'users')->name('user-management.user-index');
            $route->get('role-index', 'index')->name('user-management.role-index');
            $route->get('role-edit/{id}', 'editRole')->name('user-management.role-edit');
            $route->post('role-update/{id}', 'updateRole')->name('user-management.role-update');
            $route->post('role-assign', 'role_assign')->name('user-management.role-assign');
            $route->post('role-store', 'store')->name('user-management.role-store');

            $route->get('permission-index/{id}', 'permission_index')->name('user-management.permission-index');
            $route->post('permission-store', 'permission_store')->name('user-management.permission-store');
    });
});

Route::controller(ShareLinkController::class)->prefix('/file-manager/share-links')->group(function () {
    Route::get('/view/{token}', 'view')->name('share-links.view');
    Route::post('/verify-password/{token}', 'verifyPassword')->name('share-links.verify');
});
