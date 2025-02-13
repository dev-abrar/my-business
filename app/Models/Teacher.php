<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;




class Teacher extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $guard = 'teacherlogin';

     // Define the relationship
     public function students()
     {
         return $this->hasMany(Student::class, 'teacher_id');
     }
}
