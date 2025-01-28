<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Student extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $guard = 'studentlogin';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
