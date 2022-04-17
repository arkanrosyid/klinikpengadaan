<?php

namespace App\Models;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Konsultasi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function idUser($email){
        return $email->belongsToMany(User::class);
    }
  
}
