<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form wire:submit.prevent="generateReport">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="company" value="{{ __('Company') }}" />
                        <select id="company" wire:model="selectedCompany" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">{{ __('Select Company') }}</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="year" value="{{ __('Year') }}" />
                        <select id="year" wire:model="selectedYear" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            @for ($i = 2010; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="month" value="{{ __('Month') }}" />
                        <select id="month" wire:model="selectedMonth" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $index => $month)
                                <option value="{{ $index + 1 }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-label for="option" value="{{ __('Option') }}" />
                        <select id="option" wire:model="selectedOption" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="totals">{{ __('Totals') }}</option>
                            <option value="list">{{ __('List') }}</option>
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-button class="btn-primary">
                            {{ __('Generate Report') }}
                        </x-button>
                    </div>
                </form>
                @if($selectedOption == 'totals')
                    @if($reportData)
                        <div class="mt-6">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('COMPANY') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $companyName }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ __('Year') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $selectedYear }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ __('Month') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }}</td>
                                    </tr>
                                    @foreach($reportHeaders as $key => $header)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $header }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reportData[$key] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="mt-6">
                            <p>{{ __('No results found.') }}</p>
                        </div>
                    @endif
                @elseif($selectedOption == 'list')
                    @if($listData)
                        <div class="mt-6">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Employee Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Workplace') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Position') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Seniority Date') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_1'] }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_2'] }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_3'] }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_4'] }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_5'] }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_6'] }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $reportHeaders['concept_7'] }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($listData as $data)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['employee_name'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['workplace'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['position'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['seniority_date'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_1'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_2'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_3'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_4'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_5'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_6'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $data['concept_7'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                <x-button wire:click="exportToExcel" class="btn-primary">
                                    {{ __('Export to Excel') }}
                                </x-button>
                            </div>
                        </div>
                    @else
                        <div class="mt-6">
                            <p>{{ __('No results found.') }}</p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
