<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index():View
    {
        return view('user.profile');
    }
    public function updatePassword(Request $request)
    {
        //for validation
        $request->validate([
            'current_password'=> 'required|min:8|max:16',
            'new_password'=> 'required|min:8|max:16|different:current_password',
            'new_password_confirmation'=>'required|same:new_password'
        ]);

        $user = auth()->user();
        
        if(!password_verify($request->current_password, $user->password)){
            return redirect()->back()->with('error', 'A senha atual está errada!');
        }
        //update passwaord in database
        $user->password = bcrypt($request->new_password);
        $user->save();
        
        return redirect()->back()->with('success', 'Senha alterada com sucesso!');

    }
    public function updateUserData(Request $request)
    {
        // form validation
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id()
        ]);  
        // update user date
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success_change_data', 'Dados alterados com sucesso!');
    }
}
