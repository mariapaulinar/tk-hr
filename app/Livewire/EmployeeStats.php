<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class EmployeeStats extends Component
{
    public $countries;

    public function mount()
    {
        $this->countries = Country::select('countries.name as country',
            DB::raw('SUM(employees.gender = "male") as male'),
            DB::raw('SUM(employees.gender = "female") as female'))
            ->leftJoin('employees', 'countries.id', '=', 'employees.country_id')
            ->groupBy('countries.name')
            ->get()
            ->map(function ($item) {
                $item->female = (int)$item->female;
                $item->male = (int)$item->male;
                $item->total = $item->male + $item->female;
                return $item;
            });
    }

    public function render()
    {
        $totals = [
            'male' => $this->countries->sum('male'),
            'female' => $this->countries->sum('female'),
            'total' => $this->countries->sum('total')
        ];

        return view('livewire.employee-stats', [
            'totals' => $totals,
            'countries' => $this->countries
        ]);
    }
}
