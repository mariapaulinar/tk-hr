<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostsReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'employee_code',
        'year',
        'month',
        'concept_1',
        'concept_2',
        'concept_3',
        'concept_4',
        'concept_5',
        'concept_6',
        'concept_7',
        'file_path',
    ];
}
