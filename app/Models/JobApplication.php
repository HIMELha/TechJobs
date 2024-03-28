<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'job_id',
        'employer_id',
        'applied_date'
    ];

    public function employer(){
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }
}
