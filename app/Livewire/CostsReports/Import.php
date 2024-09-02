<?php

namespace App\Livewire\CostsReports;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;
use App\Imports\CostsReportImport;
use App\Models\CostsReport;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public $file;
    public $company;
    public $year;
    public $month;
    public $companies;
    public $months = [];

    public function mount()
    {
        $this->companies = Company::all();
        $this->updateMonths();
    }

    public function updatedYear()
    {
        $this->updateMonths();
    }

    public function updateMonths()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');

        if ($this->year == $currentYear) {
            $this->months = range(1, $currentMonth);
        } else {
            $this->months = range(1, 12);
        }
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,csv',
            'company' => 'required|exists:companies,id',
            'year' => 'required|integer|min:2010|max:' . date('Y'),
            'month' => 'required|integer|min:1|max:12',
        ]);

        $currentYear = date('Y');
        $currentMonth = date('n');

        if ($this->year == $currentYear && $this->month > $currentMonth) {
            $this->addError('month', 'The selected month cannot be after the current month for the current year.');
            return;
        }

        try {
            // Guardar el archivo subido
            $filePath = $this->file->store('costs_reports');
            $data = \Maatwebsite\Excel\Facades\Excel::toArray(new \App\Imports\CostsReportImport, $filePath);
            foreach ($data[0] as $key => $row) {
                if ($key == 0) {
                    continue;
                }
                \App\Models\CostsReport::create([
                    'company_id' => $this->company,
                    'employee_code' => $row[0],
                    'year' => $this->year,
                    'month' => $this->month,
                    'concept_1' => $row[1],
                    'concept_2' => $row[2],
                    'concept_3' => $row[3],
                    'concept_4' => $row[4],
                    'concept_5' => $row[5],
                    'concept_6' => $row[6],
                    'concept_7' => $row[1] + $row[2] + $row[4],
                    'file_path' => $filePath,
                ]);
            }

            session()->flash('message', 'Import successful.');
        } catch (\Exception $e) {
            $this->addError('file', 'There was an error importing the file: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.costs-reports.import', [
            'months' => $this->months,
        ]);
    }
}
