<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\EmployeeService;

class EmployeeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'full_name';
    public $sortAsc = true;
    public $perPage = 10;

    protected $service;

    public function __construct()
    {
        $this->service = app(EmployeeService::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortAsc = $this->sortField === $field ? !$this->sortAsc : true;
        $this->sortField = $field;
    }

    public function render()
    {
        // La consulta se realiza a través del servicio
        $employeesQuery = $this->service->getEmployeeQuery()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('full_name', 'like', '%' . $this->search . '%')
                             ->orWhere('personal_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');

        // Paginar la consulta
        $employees = $employeesQuery->paginate($this->perPage);

        return view('livewire.employees.employee-table', ['employees' => $employees]);
    }
}
