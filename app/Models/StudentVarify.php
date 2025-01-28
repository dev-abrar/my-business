<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentVarify extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_to_student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}
