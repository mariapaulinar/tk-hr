<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
    ];

    public function costsReports()
    {
        return $this->hasMany(CostsReport::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
