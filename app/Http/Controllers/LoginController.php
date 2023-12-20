<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Visitor;
use App\Models\VisitDetail;


class LoginController extends Controller
{
    //
    public function login()
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }
        return view('frontend.login');
    }


    public function log_in(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd($user);
        $data = $request->input();
        // echo session('user');

        if ($user && Hash::check($request->password, $user->password)) {

            // Set user session
            $request->session()->put('user', $data['email']);
            
            return redirect(route('dashboard'));
        } else {
            return redirect()->back();
        }
        
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        Auth::logout();

        return redirect()->route('login');
    }

    
}
