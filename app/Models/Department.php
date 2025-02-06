<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name'];

    public function users()
    {
      $this->belongsToMany(User::class);  
    }
}
