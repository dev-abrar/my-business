<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobProof extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Relationship with Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Relationship with JobProofImage
    public function images()
    {
        return $this->hasMany(JobProofImage::class, 'proof_id');
    }
}
