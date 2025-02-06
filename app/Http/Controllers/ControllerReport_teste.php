<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PHPJasper\PHPJasper;
use Illuminate\Support\Facades\Auth;


define('source_path', 'app/report/source/MyReports/src');
define('compiled_path', 'app/report/compiled');
define('output_path', 'app/report/output');
define('input_path', 'app\public\relatorios');

class ControllerReport extends Controller
{

  public function index()
  {
    $terapeutas =user::all();

    return view('relatorio.gerador', compact('terapeutas'));

  }

  public function getDatabaseConfigMysql()
  {

        $jdbc_dir = __DIR__ . '/vendor/lavela/phpjasper/bin/jaspertarter/jdbc';
        return [
            'driver'   => 'mysql',
            'host'     => env('DB_HOST'),
            'port'     => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
            'jdbc_driver' => 'com.mysql.jdbc.Driver',
            'jdbc_url' => 'jdbc:mysql://154.56.48.103:3306/'.env('DB_DATABASE'),
            'jdbc_dir' => $jdbc_dir

         ];

   }

   public function generateReport(Request $request)
   {
        if(isset($_POST['q_relatorio'])){

                if($_POST['q_relatorio'] == "1"){

                    $report='ficha_atendimento';
                    $options["format"] =[ "pdf"];
                    $path = storage_path(source_path);
                    $file = ".jasper";
                    $file = $path."/".$file;
                    $ext = "pdf";

                    $src = storage_path(source_path);

                    $reports = JasperController::read_files($src);
                    
                    if(!isset($reports[$report.".jrxml"])){
                        abort(404, 'Unauthorized action.');
                        return false;
                    }

                    $input = storage_path(compiled_path).'/'.$report.'.jasper';

                    $user = Auth::user();
                    $user_id = $user->id;
                    $output = JasperController::dir_check(storage_path(output_path)."/user_".$user_id);

                    $options = [
                        'locale' => 'en',
                        'db_connection' => [
                            'driver' => env('JASPER_DRIVER'),
                            'username' => env('DB_USERNAME'),
                            'host' => env('DB_HOST'),
                            'database' => env('DB_DATABASE'),
                            'port' => env('DB_PORT')
                        ]
                    ];

                    $daterange = [
                                 "start_date" => isset($_POST["data_inicio"])?$_GET["data_inicio"]:date('Y-m-d'),
                                 "end_date" => isset($_POST["data_fim"])?$_GET["data_fim"]:date("Y-m-d")];

                    try {
                        return JasperController::jasper($input,$output,$options,$file,$ext);
                    } catch (\Exception $e) {
                         return redirect()->back()->with('error',$e->getMessage());
                    }
                }

            if(isset($_POST['q_relatorio'])){
                if($_POST['q_relatorio'] == "2"){
                    echo 'Escolheu o segundo relatorio';
                }
            }
            if(isset($_POST['q_relatorio'])){
                if($_POST['q_relatorio'] == "3"){
                    echo 'Escolheu o teerceiro relatorio';
                }
            }
        }

    }

    static function jasper($input,$output,$options,$template,$ext){
        $jasper = new PHPJasper;
        $resp = $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        $filename = $template.'.'.$ext;
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
    }

}
