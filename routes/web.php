<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/company', function () {
    return view('company');
});

Route::get('/company/add', function () {
    return view('company_add');
});

Route::get('/company/{id}/edit', function ($id) {
    return view('company_edit', ['id' => $id]);
});

Route::get('/company/list', function () {
    return view('company_list');
});
