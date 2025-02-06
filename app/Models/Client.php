<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
      'cns',
      'nome',
      'sexo',
      'data_nascimento',
      'nacionalidade',
      'cpf',
      'cor',
      'etnia',
      'cep',
      'logradouro',
      'endereco',
      'numero',
      'estado_civil',
      'bairro',
      'cidade',
      'uf',
      'telefone',
      'email',
      'tipo_sangue',
      'ativ_laboral' ,
      'observacao' ,
      'update_id'    
    ];

    public function client_eventos()
    {
      $this->belongsToMany(eventos::class);
    }

}
