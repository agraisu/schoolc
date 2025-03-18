<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(123456));
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type ==1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type ==2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type ==3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type ==4)
            {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type ==1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type ==2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type ==3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type ==4)
            {
                return redirect('parent/dashboard');
            }
        }
        else{
            return redirect()->back()->with('error', 'please enter current email and password');
        }
        // dd($request->all());
    }

    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
        // getEmailSingle called as static method on User model
        // so you can call getEmailSingle directly on User class
        // without creating an instance of the User class->$user = new User();
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
            // return($user);
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Please check your email and reset your password");
        }
        else
        {
            return redirect()->back()->with('error', "Email not found in the system");
        }
        //display all data sent with the request
        // dd($request->all());
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function PostReset($token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect(url(''))->with('success', 'Password Succcesfully Reset');
        }
        else
        {
            return redirect()->back()->with('error', 'Password and Confirm Password does not match');

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
