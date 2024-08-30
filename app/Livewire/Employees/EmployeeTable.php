<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\EmployeeService;

class EmployeeTable extends Component
{
    use WithPagination;

    public $sortField = 'personal_id'; // Campo por defecto para ordenar
    public $sortDirection = 'asc'; // Dirección por defecto para ordenar

    protected $employeeService;

    public function boot(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $employees = $this->employeeService->getEmployees($this->sortField, $this->sortDirection, 10);

        return view('livewire.employees.employee-table', [
            'employees' => $employees,
        ]);
    }
}
