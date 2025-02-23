<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data=['name' => ['zockchin',1] , 'age' => 21];
    return view('welcome',$data);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('Home',[NewsController::class,'index']);

Route::get('Redir/{Service}',[SocialController::class,'redirect'])->name('redir_FB');
Route::get('/callback/{Service}',[SocialController::class,'callback']);




Route::post('insert_offer',[OfferController::class,'store'])->name('store_offer');
Route::get('create_offer',[OfferController::class,'create']);


