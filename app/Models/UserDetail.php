<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserDetail extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable =[
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'telefone',
        'cns',
        'cbo',
        'data_nascimento',
        'comentario',
        'salario',
        'admission_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);    
    }
}
