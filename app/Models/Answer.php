<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    protected $fillable = ['student_id', 'answers', 'correct_answers_count'];

    protected $casts = [
        'answers' => 'array',
    ];

    function rel_to_student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}
