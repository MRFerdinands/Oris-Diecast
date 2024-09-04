<?php

use App\Livewire\Home;
use App\Livewire\Admin;
use App\Livewire\Login;
use App\Livewire\Brands;
use App\Livewire\AboutUs;
use App\Livewire\Pameran;
use App\Livewire\Exhibition;
use App\Livewire\OtherLinks;
use App\Livewire\JNEAwbCenter;
use App\Livewire\CreatePayment;
use App\Livewire\CreateProduct;
use App\Livewire\StoreLocation;
use App\Livewire\CreatePengiriman;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');

Route::get('/dashboard/aboutus', AboutUs::class)->name('aboutus')->middleware('access:A');
Route::get('/dashboard/storelocations', StoreLocation::class)->name('storelocations')->middleware('access:A');
Route::get('/dashboard/brands', Brands::class)->name('brands')->middleware('access:A');
Route::get('/dashboard/otherlinks', OtherLinks::class)->name('otherlinks')->middleware('access:A');
Route::get('/dashboard/events', Exhibition::class)->name('events')->middleware('access:A');

Route::get('/jneawbcenter', JNEAwbCenter::class)->name('jneawbcenter')->middleware('access:A,JNE,RS');
Route::get('/jneawbcenter/create', CreatePengiriman::class)->name('create')->middleware('access:A');
Route::get('/pameran', Pameran::class)->name('pameran')->middleware('access:A');
Route::get('/pameran/product', CreateProduct::class)->name('product')->middleware('access:A');
Route::get('/pameran/payment', CreatePayment::class)->name('payment')->middleware('access:A');