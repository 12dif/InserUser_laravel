<?php

use Illuminate\Support\Facades\Route;


Route::middleware([\App\Http\Middleware\setLang::class])->group(function () {

    Route::get('/',[\App\Http\Controllers\UserController::class,'home'])->name('user.show');

    Route::get('/user/create',[\App\Http\Controllers\UserController::class,'showFormCreate'])->name('user.create');
    Route::post('/user/create',[\App\Http\Controllers\UserController::class,'createUser'])->name('user.create');

    Route::get('/user/delete/{id}',
        [\App\Http\Controllers\UserController::class,'deleteUser'])->whereNumber('id')->name('user.delete');

    Route::get('/user/update/{id}',
        [\App\Http\Controllers\UserController::class,'showFormupdate'])->whereNumber('id')->name('user.update');
    Route::post('/user/update/{id}',
        [\App\Http\Controllers\UserController::class,'updateUser'])->whereNumber('id')->name('user.update');

    Route::get('/locale/{locale}',
        [\App\Http\Controllers\UserController::class,'setLang'])->whereIn('locale',['fr','en'])->name('locale');

});
