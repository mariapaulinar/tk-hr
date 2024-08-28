<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Workplace;
use App\Models\Position;
use App\Models\Country;
use App\Services\EmployeeService;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeForm extends Component
{
    public $employee;
    public $companies;
    public $workplaces;
    public $positions;
    public $countries;
    
    public $state = [
        'first_name' => '',
        'last_name' => '',
        'full_name' => '',
        'birth_date' => '',
        'age' => '',
        'start_date' => '',
        'seniority' => '',
        'company_id' => '',
        'workplace_id' => '',
        'position_id' => '',
        'country_id' => '',
    ];

    protected $employeeService;

    public function boot(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function mount($employeeId = null)
    {
        $this->companies = Company::all();
        $this->workplaces = Workplace::all();
        $this->positions = Position::all();
        $this->countries = Country::all();

        if ($employeeId) {
            $this->employee = $this->employeeService->getEmployeeById($employeeId);
            $this->state = array_merge($this->state, $this->employee->toArray());
        }
        
        $this->calculateAllFields();
    }

    public function updatedStateFirstName($value)
    {
        $this->calculateFullName();
    }

    public function updatedStateLastName($value)
    {
        $this->calculateFullName();
    }

    public function updatedStateBirthDate($value)
    {
        $this->calculateAge();
    }

    public function updatedStateStartDate($value)
    {
        $this->calculateSeniority();
    }

    public function calculateAllFields()
    {
        $this->calculateFullName();
        $this->calculateAge();
        $this->calculateSeniority();
    }

    public function calculateFullName()
    {
        $this->state['full_name'] = trim($this->state['first_name'] . ' ' . $this->state['last_name']);
    }

    public function calculateAge()
    {
        if (!empty($this->state['birth_date'])) {
            $birthDate = Carbon::parse($this->state['birth_date']);
            $this->state['age'] = $birthDate->age;
        } else {
            $this->state['age'] = '';
        }
    }

    public function calculateSeniority()
    {
        if (!empty($this->state['start_date'])) {
            $startDate = Carbon::parse($this->state['start_date']);
            $this->state['seniority'] = number_format($startDate->diffInYears(Carbon::now(), true), 1);
        } else {
            $this->state['seniority'] = '';
        }
    }

    public function saveEmployee()
    {
        $request = new StoreEmployeeRequest();
        $validatedData = $this->validate($request->rules(), $request->messages());

        try {
            DB::beginTransaction();

            if ($this->employee && $this->employee->exists) {
                $this->employeeService->updateEmployee($this->employee, $validatedData['state']);
            } else {
                $this->employeeService->createEmployee($validatedData['state']);
            }

            DB::commit();

            session()->flash('message', 'Empleado guardado exitosamente.');
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al guardar empleado: ' . $e->getMessage());
            return null;
        }
    }

    public function render()
    {
        return view('livewire.employees.employee-form');
    }
}
