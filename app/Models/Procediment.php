<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Procediment extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
      'codigo',
      'name',
      'tipo_relate',
      'ativo'
    ];


    public function Procediment_eventos()
    {
      $this->belongsToMany(eventos::class);  
    }
}
