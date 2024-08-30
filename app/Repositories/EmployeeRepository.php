<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getEmployees($sortField, $sortDirection, $perPage)
    {
        $query = Employee::query();

        if (in_array($sortField, ['position', 'company', 'workplace', 'country'])) {
            $relation = $sortField;
            $relationTable = $this->getRelationTableName($relation);
            $sortField = 'name';
            $query = $query->join($relationTable, 'employees.' . $relation . '_id', '=', $relationTable . '.id')
                           ->select('employees.*', $relationTable . '.name as ' . $relation . '_name')
                           ->orderBy($relation . '_name', $sortDirection);
        } else {
            $query = $query->orderBy($sortField, $sortDirection);
        }

        return $query->paginate($perPage);
    }

    private function getRelationTableName($relation)
    {
        $relationTables = [
            'position' => 'positions',
            'company' => 'companies',
            'workplace' => 'workplaces',
            'country' => 'countries'
        ];

        return $relationTables[$relation] ?? $relation . 's';
    }

    public function getAllEmployees()
    {
        return Employee::all();
    }

    public function findById($id)
    {
        return Employee::findOrFail($id);
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
