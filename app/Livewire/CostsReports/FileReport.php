<?php

namespace App\Livewire\CostsReports;

use Livewire\Component;
use App\Models\Company;
use App\Models\CostsReport;
use App\Models\CostsReportsConfig;
use App\Models\Employee;
use App\Models\Workplace;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CostsReportExport;
use Carbon\Carbon;

class FileReport extends Component
{
    public $selectedCompany;
    public $selectedYear;
    public $selectedMonth;
    public $selectedOption;
    public $reportHeaders = [];
    public $reportData = [];
    public $listData = [];
    public $companyName;

    public function generateReport()
    {
        $company = Company::find($this->selectedCompany);

        if (!$company) {
            session()->flash('error', 'Company not found.');
            return;
        }

        $this->companyName = $company->name;
        $countryId = $company->country_id;
        $config = CostsReportsConfig::where('country_id', $countryId)->first();

        if (!$config) {
            session()->flash('error', 'Report configuration not found.');
            return;
        }

        $this->reportHeaders = [
            'concept_1' => $config->concept_1_title,
            'concept_2' => $config->concept_2_title,
            'concept_3' => $config->concept_3_title,
            'concept_4' => $config->concept_4_title,
            'concept_5' => $config->concept_5_title,
            'concept_6' => $config->concept_6_title,
            'concept_7' => $config->concept_7_title,
        ];

        if ($this->selectedOption == 'totals') {
            $this->generateTotalsReport();
        } elseif ($this->selectedOption == 'list') {
            $this->generateListReport();
        }
    }

    private function generateTotalsReport()
    {
        $reports = CostsReport::where('company_id', $this->selectedCompany)
            ->where('year', $this->selectedYear)
            ->where('month', $this->selectedMonth)
            ->get();

        if ($reports->isEmpty()) {
            $this->reportData = null;
            return;
        }

        $this->reportData = [
            'concept_1' => $reports->sum('concept_1'),
            'concept_2' => $reports->sum('concept_2'),
            'concept_3' => $reports->sum('concept_3'),
            'concept_4' => $reports->sum('concept_4'),
            'concept_5' => $reports->sum('concept_5'),
            'concept_6' => $reports->sum('concept_6'),
            'concept_7' => $reports->sum('concept_7'),
        ];
    }

    private function generateListReport()
    {
        $reports = CostsReport::where('company_id', $this->selectedCompany)
            ->where('year', $this->selectedYear)
            ->where('month', $this->selectedMonth)
            ->get();

        $this->listData = $reports->map(function ($report) {
            $employee = Employee::where('personal_id', $report->employee_code)->first();
            $workplace = $employee ? Workplace::find($employee->workplace_id) : null;
            $seniorityDate = $employee ? $this->calculateSeniorityDate($employee->start_date) : 'Information not available';

            return [
                'employee_name' => $employee ? $employee->full_name : 'Information not available',
                'workplace' => $workplace ? $workplace->name : 'Information not available',
                'position' => $employee ? $employee->position->name : 'Information not available',
                'seniority_date' => $seniorityDate,
                'concept_1' => $report->concept_1,
                'concept_2' => $report->concept_2,
                'concept_3' => $report->concept_3,
                'concept_4' => $report->concept_4,
                'concept_5' => $report->concept_5,
                'concept_6' => $report->concept_6,
                'concept_7' => $report->concept_7,
            ];
        })->toArray();
    }

    private function calculateSeniorityDate($startDate)
    {
        $start = Carbon::parse($startDate);
        $now = Carbon::now();

        if ($start->greaterThan($now)) {
            return '0.0 años';
        }

        $years = $start->diffInYears($now);
        $months = $start->diffInMonths($now) % 12;
        $seniority = $years + ($months / 12);

        return number_format($seniority, 1) . ' años';
    }

    public function exportToExcel()
    {
        $countryId = Company::find($this->selectedCompany)->country_id;
        $config = CostsReportsConfig::where('country_id', $countryId)->first();

        $headers = [
            'Employee Name',
            'Workplace',
            'Position',
            'Seniority Date',
            $config->concept_1_title,
            $config->concept_2_title,
            $config->concept_3_title,
            $config->concept_4_title,
            $config->concept_5_title,
            $config->concept_6_title,
            $config->concept_7_title,
        ];

        return Excel::download(new CostsReportExport($this->listData, $headers), 'costs_report.xlsx');
    }

    public function render()
    {
        return view('livewire.costs-reports.file-report', [
            'companies' => Company::all(),
        ]);
    }
}
