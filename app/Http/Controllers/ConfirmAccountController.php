<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmAccountController extends Controller
{
    public function ConfirmAccount($token)
    {
        //chech if the token is valid
        $user = User::where('Confirmation_token', $token)->first();
        
        if(!$user){
            abort(403, 'Token de Confirmação inválido');
        }
        return view('auth.confirm-account', compact('user'));
    }

    public function confirmAccountsubmit(Request $request)
    {
        //form validation
        $request->validate([
            'token' => 'required|string|size:60',
            'password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ]);

        $user = User::where('confirmation_token',  $request->token)->first();
        $user->password = bcrypt($request->password);
        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return view('auth.welcome')->with('user', $user);

    }

}
