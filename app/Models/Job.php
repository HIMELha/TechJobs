<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'job_type_id',
        'vacancy',
        'min_salary',
        'max_salary',
        'description',
        'benifits',
        'responsibility',
        'qualifications',
        'experience',
        'keywords',
        'company_name',
        'company_location',
        'company_website',
    ];
}
