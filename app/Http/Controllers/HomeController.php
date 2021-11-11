<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifyAccounts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function privacy(){
        return view('privacy');
    }
    public function terms(){
        return view('terms');
    }

    public function about(){
        return view('about');
    }
    public function contact(){
        return view('about');
    }
    public function postContact(Request $request){
        return redirect()->back();
    }

    public function verify(Request $request){
        if($request->has('token')){
            $verify = (new VerifyAccounts)->where('token',$request->token)->first();
            if($verify){
                $User = User::where('id',$verify->user_id)->first();
                if($User->email_verified_at == null){
                    $User->email_verified_at = now();
                    $User->save();
                    $message = 'Email Verified Successfully';
                }else
                    $message = 'Email Verified Before !';
            }else
                $message = 'Verification Token is invalid !';
        }else
            $message = 'Verification Token is required !';
        return view('mail.verification_done',compact('message'));
    }
}
