<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobProofImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function proof()
    {
        return $this->belongsTo(JobProof::class, 'proof_id');
    }
}
