<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getEmployeeQuery()
    {
        return Employee::query()->with(['company', 'workplace', 'position', 'country']);
    }

    public function getAll()
    {
        return $this->getEmployeeQuery()->get();
    }

    public function findById($id)
    {
        return $this->getEmployeeQuery()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update(Employee $employee, array $data)
    {
        $employee->update($data);
        return $employee;
    }

    public function delete(Employee $employee)
    {
        return $employee->delete();
    }
}