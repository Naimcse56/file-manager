<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;

Auth::routes();


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/mututal-assesments/change-password', [HomeController::class, 'change_password'])->name('change_password');
    Route::post('/mututal-assesments/update-change-password', [HomeController::class, 'update_change_password'])->name('update_change_password');
});

Route::middleware(['auth', 'verified', 'check_password_changed'])->prefix('/mututal-assesments')->group(function () {
    Route::controller(UserController::class)->prefix('/users')->group(function () {
        Route::get('/index', 'index')->name('user.index');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/update/{id}', 'update')->name('user.update');
        Route::post('/delete', 'destroy')->name('user.delete');
        Route::get('/select-list-ajax', 'list_for_select_ajax')->name('user.list_for_select_ajax');
        Route::get('/select-list-ajax-based-on-classification', 'list_for_select_ajax_based_on_classification')->name('user.list_for_select_ajax_based_on_classification');
        Route::get('/select-list-ajax-cp-based-on-syndicate', 'list_for_select_ajax_cp_based_on_syndicate')->name('user.list_for_select_ajax_cp_based_on_syndicate');

    });
    Route::controller(CityController::class)->prefix('/cities')->group(function () {
        Route::get('/index', 'index')->name('cities.index');
        Route::post('/store', 'store')->name('cities.store');
        Route::get('/edit/{id}', 'edit')->name('cities.edit');
        Route::post('/update/{id}', 'update')->name('cities.update');
        Route::get('/select-list-ajax', 'list_for_select_ajax')->name('cities.list_for_select_ajax');
        Route::get('/select-list-ajax-state', 'list_for_select_ajax_state')->name('state.list_for_select_ajax');
        Route::get('/select-list-ajax-country', 'list_for_select_ajax_country')->name('country.list_for_select_ajax');

    });
});
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
