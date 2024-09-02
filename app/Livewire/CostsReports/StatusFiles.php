<?php

namespace App\Livewire\CostsReports;

use Livewire\Component;
use App\Models\Company;
use App\Models\CostsReport;

class StatusFiles extends Component
{
    public $companies;
    public $years = [];
    public $months = [];
    public $selectedYear;
    public $selectedMonth;
    public $selectedCompany;
    public $results = [];
    public $resultsByYearMonth = [];
    public $resultsByCompany = [];

    public function mount()
    {
        $this->companies = Company::orderBy('name')->get();
        $this->years = range(date('Y'), 2010);
        $this->months = range(1, 12);
    }

    public function updatedSelectedYear()
    {
        $this->resultsByYearMonth = [];
    }

    public function updatedSelectedMonth()
    {
        $this->resultsByYearMonth = [];
    }

    public function updatedSelectedCompany()
    {
        $this->resultsByCompany = [];
    }

    public function search()
    {
        if ($this->selectedYear && $this->selectedMonth) {
            $this->searchByYearMonth();
        } elseif ($this->selectedCompany) {
            $this->searchByCompany();
        }
    }

    public function searchByYearMonth()
    {
        $this->resultsByYearMonth = []; // Limpiar resultados antes de la búsqueda
        $this->resultsByYearMonth = Company::with(['costsReports' => function($query) {
            $query->where('year', $this->selectedYear)
                  ->where('month', $this->selectedMonth);
        }])->orderBy('name')->get();
    }

    public function searchByCompany()
    {
        $this->resultsByCompany = []; // Limpiar resultados antes de la búsqueda
        $this->resultsByCompany = CostsReport::where('company_id', $this->selectedCompany)
                                    ->orderBy('year', 'desc')
                                    ->orderBy('month', 'desc')
                                    ->groupBy(['year', 'month'])
                                    ->get();
    }

    public function render()
    {
        return view('livewire.costs-reports.status-files');
    }
}
