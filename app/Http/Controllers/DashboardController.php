<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\UserDetail;
use App\Models\eventos;
use App\Models\Procediment;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;

class DashboardController extends Controller
{
 
    public function index() {
        //conta numero de usuarios no sistema
        $clientes = client::all()->count();

        $user_id =  Auth::user()->id;

        $teste_valor = eventos::where('user_id',$user_id)
        ->whereYear('start',date('Y'))
        ->count();
        

        if ($teste_valor<'1'){    //Ele é administrador

                //conta o numero de atendimentos no ano para o usuario atual        
                $atendidoAno = eventos::whereYear('start',date('Y'))->count();
                

                //conta o mumero de atendimentos no mês para o usuaior atual
                $atendidoMes = eventos::whereMonth('start',date('m'))->count();


                //retorna o array do grafico 1 - usuarios
                $clientesMes = eventos::select([
                        //DB::raw("MONTH(start) as mes"),
                        DB::raw("DATE_FORMAT(start,'%m/%Y') as mes"),
                        DB::raw("COUNT(*) as total")
                ])
                //->whereYear('created_at',date('Y'))
                ->groupBy('mes')
                ->orderBy('mes', 'asc')
                ->get();

                foreach($clientesMes as $mese){
                    
                    $mes_num = substr($mese->mes, 0, 2);
                    $ano_num = substr($mese->mes, 3, 4);
                    
                    if($mes_num == 01){
                        $mes_nome = "Jan";
                        }elseif($mes_num == '02'){
                        $mes_nome = "Fev";
                        }elseif($mes_num == '03'){
                        $mes_nome = "Mar";
                        }elseif($mes_num == '04'){
                        $mes_nome = "Abr";
                        }elseif($mes_num == '05'){
                        $mes_nome = "Mai";
                        }elseif($mes_num == '06'){
                        $mes_nome = "Jun";
                        }elseif($mes_num == '07'){
                        $mes_nome = "Jul";
                        }elseif($mes_num == '08'){
                        $mes_nome = "Ago";
                        }elseif($mes_num == '09'){
                        $mes_nome = "Set";
                        }elseif($mes_num == '10'){
                        $mes_nome = "Out";
                        }elseif($mes_num == '11'){
                        $mes_nome = 'Nov';
                        }else{
                        $mes_nome = 'Dez';
                        };

                    $mes[] = $mese->mes;
                    $mes_nomes[] = '"'.$mes_nome.'/'.$ano_num.'"';
                    $total[] = $mese->total;
                }    
                $clienteNomeMes =[];

                //Formatar para o padrao array Chart.js do grafico 1
                $clienteNomeMes = implode(',',$mes_nomes);
                $clienteMes = implode(',', $mes);
                $clienteTotal = implode(',', $total);

                //retorna o array do grafico 2 - Procedimentos
                $AnoProcedimento = DB::table('eventos')
                    ->select(DB::raw('procediments.name, eventos.procediments_id ,eventos.status, eventos.created_at'))
                    ->where('status','1')
                    ->whereYear('eventos.start',date('Y'))
                    ->join('procediments', function( JoinClause $join){
                        $join->on('procediments.id','=','eventos.procediments_id');
                    })
                    ->select(DB::raw('count(eventos.procediments_id) as ptotal, procediments.name'))
                    ->groupBy('procediments.name')
                    ->get();

                    foreach($AnoProcedimento as $proc){
            
                        $proc_nomes[] = '"'.$proc->name.'"';
                        $ptotal[] = $proc->ptotal;
                    }     
                    //Formatar para o padrao array Chart.js do grafico 2
                    $ProcedimentoAno = implode(',', $proc_nomes);
                    $ProcediementoTotal= implode(',', $ptotal);
        
                return view('home', compact('clientes','atendidoAno','atendidoMes','clienteNomeMes','clienteMes','clienteTotal','ProcedimentoAno','ProcediementoTotal'));
        }
        else{
                    //Ele é usuario SEM DIREITO DE ADMINISTRADOR
                    //conta o numero de atendimentos no ano para o usuario atual  
                    $teste_valor = eventos::where('user_id',$user_id)
                    ->whereYear('start',date('Y'))
                    ->count();
                 
                    $atendidoAno = eventos::where('user_id',$user_id)
                    ->whereYear('start',date('Y'))
                    ->count();                            
    
                    //conta o mumero de atendimentos no mês para o usuaior atual
                    $atendidoMes = eventos::where('user_id',$user_id)
                    ->whereMonth('start',date('m'))->count();                                       
    
                    //retorna o array do grafico 1 - usuarios
                    $clientesMes = eventos::select([
                    //DB::raw("MONTH(start) as mes"),
                    DB::raw("DATE_FORMAT(start,'%m/%Y') as mes"),
                    DB::raw("COUNT(*) as total")  ])
                    ->where('user_id',$user_id)
                    //->whereYear('created_at',date('Y'))
                    ->groupBy('mes')
                    ->orderBy('mes', 'asc')
                    ->get();
                                
                    foreach($clientesMes as $mese){
                                
                        $mes_num = substr($mese->mes, 0, 2);
                        $ano_num = substr($mese->mes, 3, 4);
                                
                        if($mes_num == 01){
                            $mes_nome = "Jan";
                        }elseif($mes_num == '02'){
                            $mes_nome = "Fev";
                        }elseif($mes_num == '03'){
                            $mes_nome = "Mar";
                        }elseif($mes_num == '04'){
                            $mes_nome = "Abr";
                        }elseif($mes_num == '05'){
                            $mes_nome = "Mai";
                        }elseif($mes_num == '06'){
                            $mes_nome = "Jun";
                        }elseif($mes_num == '07'){
                            $mes_nome = "Jul";
                        }elseif($mes_num == '08'){
                            $mes_nome = "Ago";
                        }elseif($mes_num == '09'){
                            $mes_nome = "Set";
                        }elseif($mes_num == '10'){
                            $mes_nome = "Out";
                        }elseif($mes_num == '11'){
                            $mes_nome = 'Nov';
                        }else{
                            $mes_nome = 'Dez';
                        };
                        $mes[] = $mese->mes;
                        $mes_nomes[] = '"'.$mes_nome.'/'.$ano_num.'"';
                        $total[] = $mese->total;  
                              
                        $clienteNomeMes =[];
            
                        //Formatar para o padrao array Chart.js do grafico 1
                        $clienteNomeMes = implode(',',$mes_nomes);
                        $clienteMes = implode(',', $mes);
                        $clienteTotal = implode(',', $total);
    
                    };
                    //retorna o array do grafico 2 - Procedimentos
                    $AnoProcedimento = DB::table('eventos')
                    ->select(DB::raw('procediments.name,eventos.start,eventos.procediments_id ,eventos.status, eventos.created_at'))
                    ->where('status','1')
                    ->whereYear('eventos.start',date('Y'))
                    ->where('user_id',$user_id)
                    ->join('procediments', function( JoinClause $join){
                        $join->on('procediments.id','=','eventos.procediments_id');})
                    ->select(DB::raw('count(eventos.procediments_id) as ptotal, procediments.name'))
                    ->groupBy('procediments.name')
                    ->get();
               
                    foreach($AnoProcedimento as $proc){                
                        $proc_nomes[] = '"'.$proc->name.'"';
                        $ptotal[] = $proc->ptotal;
                    }     
                    $ProcediementoTotal= implode(',', $ptotal); 
                    $ProcedimentoAno = implode(',', $proc_nomes);                       
                            
               
                    return view('home', compact('clientes','atendidoAno','atendidoMes','clienteNomeMes','clienteMes','clienteTotal','ProcedimentoAno','ProcediementoTotal')); 
            }
        }
}