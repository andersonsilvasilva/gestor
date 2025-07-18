<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable ;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    use HasFactory;
    use Notifiable;

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function user_department()
    {
        return  $this->belongsTo(Department::class);

    }
    public function user_eventos()
    {
      $this->belongsToMany(eventos::class);  
    }

}
