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
}
