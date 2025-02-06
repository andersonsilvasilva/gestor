<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class RhUserController extends Controller
{
    public function index()
    {
       // Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
        
        //$colaborators = User::where('role','rh')->get();
        $colaborators = User::with('detail')
                        ->orderBy('name','asc')
                        ->where('role',['rh'])
                        ->get()
; 

        return view('colaborators.rh-users', compact('colaborators'));  
    }
    public function newColaborator()
    {
        Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        // get all departments

        $departments = Department::all();

        return view('colaborators.add-rh-user', compact('departments'));
     }

    public function createRhColaborator(Request $request)
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
        
 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'select_department' => 'required|exists:departments,id',
            'endereco' => 'required|string|max:200',
            'bairro' => 'required|string|max:100',
            'cep' => 'required|string|max:10',
            'cidade' => 'required|string|max:50',
            'telefone' => 'required|string|max:20',
            'cns' => 'required|string|max:20',
            'cbo' => 'required|string|max:6',
            'data_nascimento' => 'required|date_format:Y-m-d',
        ]);

        // Create confirmation token
        $token = Str::random(60);

        // create new colaborador 
        $user = new  User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->confirmation_token = $token;
        $user->role = 'rh';
        $user->department_id = $request->select_department;
        $user->permissions = '["rh"]';
        $user->save();

        //save user details
        $user->detail()->create([
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'cidade' => $request->cidade,
            'telefone' => $request->telefone,
            'cns' => $request->cns,
            'cbo' => $request->cbo,
            'data_nascimento' => \Carbon\Carbon::parse($request->data_nascimento)->format('Y/m/d'),
            'comentario' => $request->comentario,
            'salario' => $request->salario,
            'admission_date' =>\Carbon\Carbon::parse($request->admission_date)->format('Y/m/d') ,
        ]);

        try {
            //send email to user
            Mail::to($user->email)->send(new ConfirmAccountEmail(route('confirmAccount', $token)));
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar e-mail: ' . $e->getMessage());
        }
        return redirect()->route('colaborators.rh-users')->with('success','Colaborador criado com sucesso!');
    }
    public function editRhColaborator($id)
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        
        $colaborator = User::with('detail')->where('role', 'rh')->findOrFail($id);


        return view('colaborators.edita-rh-user', compact('colaborator'));
        
    }
    public function updateRhColaborator(Request $request)
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
  

        $request->validate([
            'id' => 'required|exists:users,id',
            'telefone' => 'required|string|max:20',
            'salario'=> 'required|decimal:2',
            'data_nascimento'=> 'required|date_format:Y-m-d',
            'cns'=> 'required|string|max:20',
            'cbo'=> 'required|string|max:6',
            'admission_date'=> 'required|date_format:Y-m-d'
        ]);
        $user = User::findOrFail($request->id);
        $user->detail->update([
            'telefone' => $request->telefone,
            'salario' => $request->salario,
            'data_nascimento' =>  \Carbon\Carbon::parse($request->data_nascimento)->format('Y/m/d'),
            'cns' => $request->cns,
            'cbo' => $request->cbo,
            'admission_date' => \Carbon\Carbon::parse($request->admission_date)->format('Y/m/d')
        ]);


        return redirect()->route('colaborators.rh-users')->with('success', 'Alterado com sucesso!');

    }
    Public function deleteRhColaborator($id)
    {
        Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        //if(Auth::user()->id === $id){
        //     return redirect()->route('home');
        //}

        $colaborator = User::findOrFail($id);
        

        return view('colaborators.delete-Rh-user', compact('colaborator'));

    }
    public function deleteRhColaboratorConfirm($id)
    {
        Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
        
        $colaborator = User::findOrFail($id);
        $colaborator->detail->delete();
        $colaborator->delete();

        return redirect()->route('colaborators.rh-users')->with('success', 'Deletado com sucesso!');


    }

}
