<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrappingController;

Route::group(['prefix' => '/v1/'], function () {
	Route::get('/', [ScrappingController::class, 'index'])->name('scrapping.index');
});