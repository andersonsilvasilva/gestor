<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Moviment;
use Carbon\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
      Auth::user()->can('Admin') ?: abort(403, ' Você não tem permissão para acessar está página');

      //Coletar todas as informações 
      $data=[];

      // Quantos Clientes não Deletados  
      $data['total_clientes'] = Client::whereNull('deleted_at')->count();

      // Total de Clientes Deletados  
      $data['total_clientes_atendidos'] = Client::onlyTrashed()->count();  

      // Total de Atendimentos do usuario conectado
      $data['Total_atendimentos_user'] = Client::withoutTrashed()
                                    ->with('Moviment','user')
                                    ->where('user_id', Auth()->user()->$id)
                                    ->get()
                                    ->count();

      //Total de Atendimentos na unidade por mes 
      $data['Total_atendimentos_mes'] = Client::withoutTrashed()
                ->with('Moviment', 'user')
                ->get()
                ->groupBy('data_atendimento') 
                ->map(function($Moviment){
                    return [
                        'Moviment' => $Moviment->first()->moviment->data_atendimento->count()
                    ];
                });

       //dd($data);                           

       return view('home', compact('data'));

    }
}
