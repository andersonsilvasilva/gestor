<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventos;
use App\Models\Client;
use App\Models\User;
use App\Models\Procediment;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListarAtender extends Controller
{
    public function index ($id)
    {
       // Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

       $id = $this->decryptId($id);

       $clientes = Client::findOrFail($id);

       $procedimentos = Procediment::orderBy('name', 'asc')->get();
   
       $terapeutas =user::orderBy('name', 'asc')->get();       

       $eventos = DB::table('eventos')
           ->join('procediments','eventos.procediments_id','=','procediments.id' )
           ->join('users','eventos.user_id','=','users.id' )
           ->join('clients','eventos.client_id','=','clients.id' )
           ->select('eventos.*','eventos.user_id as userid','eventos.id as ordem','procediments.name as procedimento',
           'clients.id','clients.cns as codigo','clients.nome as nomecliente','clients.telefone','users.name as terapeuta')
           ->where('eventos.client_id',$id)
           ->orderBy('eventos.start', 'asc')
           ->paginate(6);
        
       return view('clientes.listar', compact('eventos'),compact('clientes'),compact('procedimentos'),compact('terapeutas'));

    }


    
    public function update(Request $request)
    {            

        $validator = validator::make(request()->all(),[
            'descricao'     => 'min:0|max:1024' 
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->getMessages(),
            ],400);  
        }
        $teste=eventos::find($request->ordem);
        $teste->update([
            'descricao'  => $request->descricao,
        ]);

        return response()->json([
            'success'=> 'Eventos atualizado com sucesso'
        ], 201);

    }

    private function decryptId($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $id;
    }
}
