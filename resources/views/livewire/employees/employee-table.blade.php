<!-- resources/views/livewire/employee-table.blade.php -->

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Employees</h2>
                    <a href="{{ route('employees.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        CREATE EMPLOYEE
                    </a>
                </div>

                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                            <tr class="text-left">
                                @php
                                    $columns = [
                                        'personal_id' => 'PERSONAL ID',
                                        'full_name' => 'FULL NAME',
                                        'position' => 'POSITION',
                                        'company' => 'COMPANY',
                                        'workplace' => 'WORKPLACE',
                                        'country' => 'COUNTRY'
                                    ];
                                @endphp
                                @foreach($columns as $column => $label)
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        <div class="flex items-center">
                                            {{ $label }}
                                            <a href="{{ route('employees.index', ['sort' => $column, 'direction' => request('sort') == $column && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path></svg>
                                            </a>
                                        </div>
                                    </th>
                                @endforeach
                                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $employee->personal_id }}</td>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $employee->full_name }}</td>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $employee->position->name }}</td>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $employee->company->name }}</td>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $employee->workplace->name }}</td>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $employee->country->name }}</td>
                                    <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                        <a href="{{ route('employees.edit', $employee) }}" class="px-3 py-1 text-sm text-indigo-600 bg-indigo-100 rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <div>
                        {{ $employees->links() }}
                    </div>
                    <div class="flex items-center">
                        <span class="mr-3 text-sm text-gray-600">Items per page:</span>
                        <select class="form-select rounded-md shadow-sm mt-1 block text-sm" onchange="window.location.href = this.value">
                            @foreach([10, 25, 50, 100] as $perPage)
                                <option value="{{ request()->fullUrlWithQuery(['per_page' => $perPage]) }}" {{ request('per_page') == $perPage ? 'selected' : '' }}>
                                    {{ $perPage }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
