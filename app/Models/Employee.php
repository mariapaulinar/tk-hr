<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'personal_id', 'first_name', 'last_name', 'full_name',
        'birth_date', 'start_date', 'gender',
        'company_id', 'workplace_id', 'position_id', 'country_id', 'photo'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function workplace()
    {
        return $this->belongsTo(Workplace::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
