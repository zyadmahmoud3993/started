<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($Service){
        return Socialite::driver($Service)->redirect();
    }
    public function callback($Service){
        return response()->json(Socialite::driver($Service)->user(),200);
    }
}
