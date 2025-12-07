<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\GeneralUSeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/dashboard', [GeneralUSeController::class, 'index'])->name('dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('books')
    ->name('books.')
    ->controller(BookController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'destroy')->name('delete');
    });

Route::prefix('staffs')
    ->name('staffs.')
    ->controller(StaffController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'destroy')->name('delete');
    });

Route::prefix('members')
    ->name('members.')
    ->controller(MemberController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'destroy')->name('delete');
    });

Route::prefix('borrowings')
    ->name('borrowings.')
    ->controller(BorrowingController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        // Route::get('/borrowings/create', \App\Livewire\CreateBorrowing::class)
        //     ->name('create');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/back', 'BookBack')->name('bookBack');
        Route::get('/{id}', 'destroy')->name('delete');
    });

Route::prefix('fines')
    ->name('fines.')
    ->controller(FineController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/pay', 'pay')->name('pay');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'waive')->name('waive');
    });

Route::prefix('genres')
    ->name('genres.')
    ->controller(GenreController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'destroy')->name('delete');
    });

Route::prefix('authors')
    ->name('authors.')
    ->controller(AuthorController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        // Route::get('/borrowings/create', \App\Livewire\CreateBorrowing::class)
        //     ->name('create');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'destroy')->name('delete');
    });

Route::prefix('publishers')
    ->name('publishers.')
    ->controller(PublisherController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        // Route::get('/borrowings/create', \App\Livewire\CreateBorrowing::class)
        //     ->name('create');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}', 'destroy')->name('delete');
    });
