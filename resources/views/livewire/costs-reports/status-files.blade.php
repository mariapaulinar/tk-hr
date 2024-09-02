<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div x-data="{ activeTab: 'year-month' }">
                    <div x-data="{ activeTab: 'general' }" class="col-span-6">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <a @click.prevent="activeTab = 'general'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'general', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'general'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer">
                                    {{ __('By Year and Month') }}
                                </a>
                                <a @click.prevent="activeTab = 'organization'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'organization', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'organization'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer">
                                    {{ __('By Company') }}
                                </a>
                            </nav>
                        </div>

                        <div class="mt-6 space-y-6" x-show="activeTab === 'general'" x-cloak>
                            <div class="flex space-x-4">
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="year" value="{{ __('Year') }}" />
                                    <select id="year" wire:model="selectedYear" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option value="">{{ __('Select Year') }}</option>
                                        @foreach($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="month" value="{{ __('Month') }}" />
                                    <select id="month" wire:model="selectedMonth" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option value="">{{ __('Select Month') }}</option>
                                        @foreach($months as $month)
                                        <option value="{{ $month }}">{{ DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-button wire:click="searchByYearMonth">{{ __('Search') }}</x-button>
                            </div>

                            <div class="mt-6">
                                @if($selectedYear && $selectedMonth)
                                <h3>{{ __('Results for Year') }}: {{ $selectedYear }}, {{ __('Month') }}: {{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }}</h3>
                                <ul>
                                    @foreach($resultsByYearMonth as $company)
                                    <li><strong>{{ (isset($company->name) ? $company->name : 'Unknown Company') }}</strong>: {{ optional($company->costsReports)->isNotEmpty() ? __('File Uploaded') : __('No File') }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 space-y-6" x-show="activeTab === 'organization'" x-cloak>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="company" value="{{ __('Company') }}" />
                                <select id="company" wire:model="selectedCompany" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="">{{ __('Select Company') }}</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4">
                                <x-button wire:click="searchByCompany">{{ __('Search') }}</x-button>
                            </div>

                            <div class="mt-6">
                                @if($selectedCompany)
                                <h3>{{ __('Results for Company') }}: {{ $companies->find($selectedCompany)->name }}</h3>
                                @if($resultsByCompany->isEmpty())
                                <p>{{ __('No files uploaded for this company.') }}</p>
                                @else
                                <ul>
                                    @foreach($resultsByCompany as $report)
                                    <li>{{ $report->year }}-{{ DateTime::createFromFormat('!m', $report->month)->format('F') }}: {{ __('File Uploaded') }}</li>
                                    @endforeach
                                </ul>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>