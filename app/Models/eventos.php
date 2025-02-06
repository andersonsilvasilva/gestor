<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class eventos extends Model
{

    use HasFactory;
    use Notifiable;
    //use SoftDeletes;
    
    protected $fillable = [
        'client_id',
        'user_id',
        'procediments_id',
        'title',
        'start',
        'end',
        'color',
        'descricao',
        'status'
    
    ];

    public function user_eventos() 
    {
      $this->belongsToMany(User::class);  
    }

    public function client_eventos()
    {
      $this->belongsToMany(Client::class);
    }

    public function Procediment_eventos()
    {
      $this->belongsToMany(Procediment::class);  
    }
}
