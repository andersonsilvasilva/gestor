<?php

namespace App\Http\Controllers;


use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\IsEmpty;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Mockery\Matcher\Contains;
use App\Http\Requests\ContaRequest;
use DateTime;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
       // Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        $clientes = Client::when($request->has('nome'), function($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
        ->orderBy('nome','asc')
        ->withTrashed()
        ->paginate(11)
        ->withQueryString();  


        return view('clientes.cliente',[
            'clientes' => $clientes,
            'nome' => $request->nome,
        ]);

    }

    public function newCliente()
    {
       //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        return view('clientes.add-cliente');


    }

    public function deleteCliente($id)
    {
        //Auth::user()->can('admin','rh') ?: abort(403, "Você não tem acesso a essa página!");
        $id = $this->decryptId($id);

        $clientes = Client::findOrFail($id);
     
        return view('clientes.delete-clientes-confirm', compact('clientes'));

    }

    public function deleteClienteConfirm($id)
    {
        //Auth::user()->can('admin','rh') ?: abort(403, "Você não tem acesso a essa página!");

        $clientes = Client::findOrFail($id);

        $clientes->delete();
     
        return redirect()->route('clientes')->with('success', 'Deletado com sucesso!');

    }

    public function editCliente($id)
    {
        //Auth::user()->can('admin','rh') ?: abort(403, "Você não tem acesso a essa página!");
        
        $id = $this->decryptId($id);

        $clientes = Client::findOrFail($id);

        return view('clientes.edita-clientes', compact('clientes'));

    }

    public function updateCliente(Request $request, $id)
    {
        $id = $this->decryptId($id);        
              
        $request->validate([
                    'cns'               => 'required',
                    'cpf'               => 'required',
                    'cor'               => 'required',
                    'nome'              => 'required',
                    'sexo'              => 'required',
                    'data_nascimento'   => 'required',
                    'cep'               => 'required',
                    'logradouro'        => 'required',
                    'endereco'          => 'required',
                    'numero'            => 'required',
                    'telefone'          => 'required',
                    'estado_civil'      => 'required',
                    'bairro'            => 'required',
                    'cidade'            => 'required',
                    'uf'                => 'required',
                    'telefone'          => 'required',
                    'tipo_sangue'       => 'required'

        ]);
       // dd($request->nacionalidade);
        
        $clientes = Client::findOrFail($id); 

        $clientes->update([
                    'cns'               => $request->cns,
                    'cpf'               => $request->cpf,
                    'cor'               => $request->cor,
                    'etnia'             => $request->etnia,
                    'nome'              => $request->nome,
                    'sexo'              => $request->sexo,
                    'data_nascimento'   => \Carbon\Carbon::parse($request->data_nascimento)->format('Y/m/d'),
                    'nacionalidade'     => $request->nacionalidade,
                    'cep'               => $request->cep,
                    'logradouro'        => $request->logradouro,
                    'endereco'          => $request->endereco,
                    'numero'            => $request->numero,
                    'telefone'          => $request->telefone,
                    'estado_civil'      => $request->estado_civil,
                    'bairro'            => $request->bairro,
                    'cidade'            => $request->cidade,
                    'uf'                => $request->uf,
                    'telefone'          => $request->telefone,
                    'email'             => $request->email,
                    'tipo_sangue'       => $request->tipo_sangue,
                    'ativ_laboral'      => $request->ativ_laboral,
                    'observacao'        => $request->observacao
        ]);

    return redirect()->route('clientes')->with('success', 'Alterado com sucesso!');

    }
    public function showDetails($id)
    {
       // Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

       $id = $this->decryptId($id);

       $clientes = Client::where('id', $id)->first();

       return view('clientes.show-clientes',compact('clientes'));

    }

    public function createCliente(ContaRequest $request)
    {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        $request->validated();

        Client::create($request->all());

        return redirect()->route('clientes')->with('success', 'Novo cadastro efetuado com sucesso!');
    }

    public function restoreClient($id)
    {
       //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

       $id = $this->decryptId($id);

       $clientes = Client::withTrashed()->findOrFail($id);
       
       $clientes->restore();

       return redirect()->route('clientes')->with('success', 'Recuperado o cliente com sucesso!');

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
