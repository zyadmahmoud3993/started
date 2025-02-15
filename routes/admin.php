<?php

use App\Http\Controllers\Forent\UserController;
use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return 'welcome';
});

// Route::get('ShowAdmin',[UserController::class,'ShowAdminName']);

// Route::fallback(function(){
//     return 'not found';
// });