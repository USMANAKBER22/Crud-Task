<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers;
use App\Http\Controllers\taskcontroller;



Route::get('/', [taskcontroller::class, 'show']);

Route::get('/edit/{id}', [taskcontroller::class, 'edit'])->name('edit.user');


Route::post('/update/{id}', [taskcontroller::class, 'update'])->name('update.user');

Route::post('/store', [taskcontroller::class, 'store']);

Route::delete('/delete/{id}', [taskcontroller::class, 'delete']); 

