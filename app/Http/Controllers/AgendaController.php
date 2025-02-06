<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Procediment;
use App\Models\eventos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;
use App\Http\Requests\AgendaRequest;
use DateTime;

class AgendaController extends Controller
{
    public function index($id)
    {

        $id = $this->decryptId($id);
        
        $cliente=Client::find($id);
        
        $procedimentos = Procediment::Orderby('name','asc')->get();

        $terapeutas = user::where('id',Auth::user()->id)->first();

        return view('agenda.index',compact('cliente','terapeutas','procedimentos'));    
    }

    public function agendaAdd($id)
    {
        $cliente=Client::find($id);

        $procedimentos = Procediment::all();

        $terapeutas =user::all();
    
        return view('agenda.add', compact('cliente','terapeutas','procedimentos'));    
    }

    public function getEvents()
    {
        $eventos = DB::table('eventos')
            ->join('procediments','eventos.procediments_id','=','procediments.id' )
            ->join('users','eventos.user_id','=','users.id' )
            ->join('clients','eventos.client_id','=','clients.id' )
            ->select('eventos.*','procediments.name as procedimento','clients.cns as codigo','clients.nome as nomecliente','clients.telefone','users.name as terapeuta')
            ->where('status','1')
            ->where('users.id',Auth::user()->id)
            ->get();

        return response()->json($eventos);
    }

    public function mostraDados($id)
    {
        $dados = eventos::findOrFail($id);
        $procedimentos= $dados->procediments_id->name;
        $terapeutas= $dados->user_id->name;

     return response()->json($dados,$procedimentos,$terapeutas);
    }

    public function create(Request $request)
    {
        $eventos = $request->all();
   
        $eventos = eventos::create($eventos);
       
       return  redirect()->route('clientes')->with('sucesso', 'Evento criado com sucesso!');
       //return response()->json('Eventos Cadastrado com sucesso');

    } 

    public function store(Request $request)
    {
               
        $request->validate([

            'title'         => 'required|string',
            'start'         => 'required',
            'end'           => 'required',
            'terapeuta'     => 'required|string',
            'procedimento'  => 'required|string',
            'color'         => 'required',
            'descricao'     => 'required|string|max:1024'            
        ]);
    
        eventos::create([
            'client_id'             => $request->client_id,
            'procediments_id'       => $request->procediments_id,
            'user_id'               => $request->user_id,
            'title'                 => $request->title,
            'start'                 => $request->start_date,
            'end'                   => $request->end_date,
            'descricao'             => $request->descricao,
            'color'                 => $request->color,
        ]);
        
        return response()->json('Eventos Cadastrado com sucesso');
       // return  redirect()->route('clientes')->with('sucesso', 'Evento criado com sucesso!');
        
    }

    public function update(Request $request, $id)
    {
        $bookings = eventos::findOrFail($id);
        $bookings->update([
            'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
            'end'   => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
        ]);

        return response()->json('Eventos atualizado');
    }

    public function deleteEvent($id)
    {

        $schedule = eventos::findOrFail($id);
        $schedule->delete();

        return response()->json(['message'=>'Evento apagado com sucesso']);
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

