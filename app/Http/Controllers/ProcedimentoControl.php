<?php

namespace App\Http\Controllers;

use App\Models\Procediment;
use Database\Seeders\ProcedimentoSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class ProcedimentoControl extends Controller
{
    public function index()
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        $procedimentos = Procediment::orderBy('name','asc')
            ->paginate(10)
            ->withQueryString();      
     
     
        return view('procedimento.procedimentos', compact('procedimentos'));

    }

    public function newProcediemento()
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        return view('procedimento.add-procedimento');

    }

    public function createProcedimento(Request $request)
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        $request->validate([
            'codigo'=> 'required|string|max:10|unique:procediments',
            'name' => 'required|string|max:150'
        ]);

        Procediment::create([     
            'codigo'=> $request->codigo,       
            'name' => $request->name,
            'ativo' => true
        ]);

        return redirect()->route('procedimentos')->with('success', 'Criado com sucesso!');
    }

    public function editProcedimento($id)
    {
          //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
     
          $procedimento = Procediment::findOrFail($id);
     
          return view('procedimento.edit-procedimento', compact('procedimento'));
     
          
    }

    public function updateProcedimento(Request $request)
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
     
        if($this->isProcedimentoBlocked($request->id)){
            return redirect()->route('procedimentos');
        }

        $request->validate([
          'id'      => 'required|exists:procediments,id',
          'codigo'  => 'required|string|max:10',
          'name'    => 'required|string|max:150',
          'ativo'   => 'required|boolean'
        ]);
        
        $procedimento = Procediment::findOrFail($request->id);
        $procedimento->update([
             'codigo' =>  $request->codigo,
             'name' => $request->name,
             'ativo' => $request->ativo
        ]);
        
        return redirect()->route('procedimentos')->with('success', 'Alterado com sucesso!');
     
          
    }

    public function deleteProcedimento($id)
    { 
      //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
      
      if($this->isProcedimentoBlocked($id)){
           return redirect()->route('procedimentos');
      }
      
      $procedimento = Procediment::findOrFail($id);

      // display page for comfirmation
 
      return view('procedimento.delete-procedimento-confirm', compact('procedimento'));
 
    }
 
    public function deleteProcedimentoConfirm($id)
    {
      //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
      
      $procedimento= Procediment::findOrFail($id);
 
      $procedimento->delete();
 
      return redirect()->route('procedimentos')->with('success', 'Deletado com sucesso!');
 
    }
 
  
    private function isProcedimentoBlocked($id)
    {
      return in_array(intval($id), [1,2]);
    }


}
