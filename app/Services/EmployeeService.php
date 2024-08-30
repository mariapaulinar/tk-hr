<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getEmployees($sortField, $sortDirection, $perPage)
    {
        return $this->employeeRepository->getEmployees($sortField, $sortDirection, $perPage);
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAllEmployees();
    }

    public function getEmployeeById($id)
    {
        return $this->employeeRepository->findById($id);
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepository->create($data);
    }

    public function updateEmployee(Employee $employee, array $data)
    {
        return $this->employeeRepository->update($employee, $data);
    }

    public function deleteEmployee(Employee $employee)
    {
        return $this->employeeRepository->delete($employee);
    }
}