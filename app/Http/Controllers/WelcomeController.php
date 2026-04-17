<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $message = "コントローラーからこんにちは";
        $today = date('Y年m月d日');

        return view('welcome', compact('message','today'));
    }
}
