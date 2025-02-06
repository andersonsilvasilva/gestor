<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;
use Ramsey\Uuid\Type\Integer;
use App\Http\Controllers\JasperController;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PHPJasper\PHPJasper;
use TCPDF;

define('driver_path', '/vendor/geekcom/phpjasper/bin/jasperstarter/jdbc');
define('source_path', '/app/public/report/source/MyReports/gestor');
define('compiled_path', '/app/public/report/compiled');
define('output_path','/app/public/report/output');

class ControllerReport extends Controller
{

  public function index()
  { 
    $terapeutas =user::all();
    
    return view('relatorio.gerador', compact('terapeutas')); 

  }  

  public function getDatabaseConfigMysql()
  {

        $jdbc_dir = base_path(driver_path);
        
        return [
                'driver'     => env("DB_CONNECTION"), 
                'host'       => env('DB_HOST','localhost'),
                'port'       => env('DB_PORT','3306'),
                'username'   => env('DB_USERNAME', 'root'),
                'password'   => env('DB_PASSWORD', ''),
                'database'   => env('DB_DATABASE', 'forge'),
                'jdbc_driver'=> 'org.mariadb.jdbc.Driver',
                'jdbc_url'   => 'jdbc:mariadb://'.env('DB_HOST', 'localhost').':'.env('DB_PORT', '3306').';databaseName='.env('DB_DATABASE', 'forge').'useTimezone=true&serverTimezone=UTC',
                'jdbc_dir'   => $jdbc_dir
                ];    

   }
   public function generateReport(Request $request)
   {  
        if(isset($_POST['q_relatorio'])){
            if($_POST['q_relatorio'] == "aveianm"){

                $report='hello';              //ALTERE AQUI O NOME DO RELATORIO A GERAR
                $path = storage_path(source_path);
                $file = $report.".jasper";
                $file = $path."/".$file;
                $ext = "pdf";

                $jasper = new PHPJasper();
                $input = storage_path(source_path).'/'.$report.'.jrxml';
                $output = storage_path(compiled_path)."/";

                
                if (!file_exists(storage_path(compiled_path).'/'.$report.'.jasper')) {
                    $jasper->compile($input,$output)->execute();
                };

                $input = storage_path(compiled_path).'/'.$report.'.jasper'; 
              
                $user = Auth::user();

                $user_id = $user->id;

                $output = storage_path(output_path)."/user_".$user_id;

                if (!file_exists(storage_path(output_path)."/user_".$user_id)) {
                    mkdir($path, 0777, true);
                }

            
                $options = [
                    'format'            => ['pdf'], 
                    'locale'            => 'pt_BR',
                    'params'            => ["id"            => isset($_POST["id_colaborador"])?$_POST["id_colaborador"]:NULL,
                                            "dta_inicio"    => isset($_POST["data_inicio"])?$_POST["data_inicio"]:$request->dta_inicio,
                                            "dta_fim"       => isset($_POST["data_fim"])?$_POST["data_fim"]:$request->dta_fim  
                                           ],
                    'db_connection'     => $this->getDatabaseConfigMysql()                      
                ];
               

                /*   
                echo $resp = $jasper->process(
                    $input,
                    $output,
                    $options)->output();
                    exit;
                  
                */  
                /*  
                echo $resp = $jasper->process(
                            $input,
                            $output,
                            array("pdf"),
                            array("id" => '2'),
                            $this->getDatabaseConfigMysql(),
                            true, 
                            true, 
                            'en')->output();
                */
            
             try {

                $resp = $jasper->process(
                        $input,
                        $output,
                        array("pdf"),
                        array(),
                        $this->getDatabaseConfigMysql(),
                        true, 
                        true, 
                        'pt_BR'
                        )->execute();
               
                $filename = $report.'.'.$ext;
                if($resp == []){
                    switch ($ext){
                        case "pdf":
                            return JasperController::pdf($output.'/'.$filename,$filename);
                            break;
                        case "xlsx":
                            return JasperController::xlsx($output.'/'.$filename,$filename);
                            break;
                        case "csv":
                            return JasperController::csv($output.'/'.$filename,$filename);
                            break;
                        case "html":
                            return JasperController::html($output.'/'.$filename,$filename);
                            break;
                                     }
                }
         
              } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            };

            }
        }  
        if(isset($_POST['q_relatorio'])){
            if($_POST['q_relatorio'] == "bpa1"){
                    echo 'Escolheu o Boletim de Produção Ambulatorial';
                }
        }
        if(isset($_POST['q_relatorio'])){
            if($_POST['q_relatorio'] == "mapa_producao"){
                    echo 'Escolheu o Mapa de Produção';
                }
        }
      
    }
    public function getParametros()
	{ 
        $report='testedb';

        $input = storage_path(source_path).'/'.$report.'.jrxml'; 

        $jasper = new PHPJasper;
        $output = $jasper->listParameters($input)->execute();
        
        foreach($output as $parameter_description)
        {
            $parameter_description = trim($parameter_description);
            //echo $parameter_description . '<br>' ;
            $dados = explode(" ", trim($parameter_description), 3 );
            echo '<strong>Parametro:</strong>  ' .  $dados[1] . 
                ' <strong>Tipo de Dados:</strong>  ' . $dados[2] . '<br>';                  
        }
	}
}