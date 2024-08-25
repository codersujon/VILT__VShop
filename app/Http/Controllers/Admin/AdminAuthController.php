<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
   /**
    * showLoginForm
    */
    public function showLoginForm(){
        return Inertia::render('Admin/Auth/Login');
    }

    /**
     * Login
     */
    public function login(Request $request){
        
        if(Auth::attempt(['email'=> $request->email, 'password'=>$request->password, 'isAdmin'=> true])){
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->with('error', 'Invalid Credentials');
    }

    /**
     * Logout
     */
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');

    }
}
