<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function test(Request $request){
        return "Test action from UserController";
    }

    public function register(Request $request){
        return "Register action to user";
    }

    public function login(Request $request){
        return "Login action to user";
    }
}
