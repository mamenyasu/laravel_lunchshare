<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showContact(){
        return view('contact');
    }

    public function contact(ContactRequest $request){
        $data=$request->validated();
        try{
            Mail::to('運営メールアドレス@example.com')->send(new ContactMail($data));
            return redirect()->route('contact.success');
        }catch(Exception $e){
            return redirect()->route('contact.fail');
        }        
    }

    public function contactSuccess(){
        return view('contactSuccess');
    }
    public function contactFail(){
        return view('contactFail');
    }
}
