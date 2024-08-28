<x-form-section submit="saveEmployee">
    <x-slot name="title">
        {{ $employee ? __('Edit employee') : __('Create employee') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Enter the employee\'s information.') }}
    </x-slot>

    <x-slot name="form">
        <div x-data="{ activeTab: 'general' }" class="col-span-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a @click.prevent="activeTab = 'general'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'general', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'general'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer">
                        {{ __('General') }}
                    </a>
                    <a @click.prevent="activeTab = 'organization'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'organization', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'organization'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer">
                        {{ __('Organisation') }}
                    </a>
                </nav>
            </div>

            <div class="mt-6 space-y-6" x-show="activeTab === 'general'">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="personal_id" value="{{ __('Personal ID') }}" />
                    <x-input id="personal_id" type="text" class="mt-1 block w-full" wire:model.defer="state.personal_id" />
                    @error('state.personal_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="first_name" value="{{ __('First Name') }}" />
                    <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model="state.first_name" />
                    @error('state.first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="state.last_name" />
                    @error('state.last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="full_name" value="{{ __('Full Name') }}" />
                    <x-input id="full_name" type="text" class="mt-1 block w-full" wire:model="state.full_name" disabled />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="birth_date" value="{{ __('Birth Date') }}" />
                    <x-input id="birth_date" type="date" class="mt-1 block w-full" wire:model="state.birth_date" />
                    @error('state.birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="age" value="{{ __('Age') }}" />
                    <x-input id="age" type="text" class="mt-1 block w-full" wire:model="state.age" disabled />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="start_date" value="{{ __('Start Date') }}" />
                    <x-input id="start_date" type="date" class="mt-1 block w-full" wire:model="state.start_date" />
                    @error('state.start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="seniority" value="{{ __('Seniority (years)') }}" />
                    <x-input id="seniority" type="text" class="mt-1 block w-full" wire:model="state.seniority" disabled />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="gender" value="{{ __('Gender') }}" />
                    <select id="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.gender">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="undefined">Undefined</option>
                    </select>
                    @error('state.gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 space-y-6" x-show="activeTab === 'organization'">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="company" value="{{ __('Company') }}" />
                    <select id="company" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.company_id">
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @error('state.company_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="work_center" value="{{ __('Work Center') }}" />
                    <select id="work_center" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.workplace_id">
                        <option value="">Select Work Center</option>
                        @foreach($workplaces as $workplace)
                            <option value="{{ $workplace->id }}">{{ $workplace->name }}</option>
                        @endforeach
                    </select>
                    @error('state.workplace_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="position" value="{{ __('Position') }}" />
                    <select id="position" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.position_id">
                        <option value="">Select Position</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                    @error('state.position_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="country" value="{{ __('Country') }}" />
                    <select id="country" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.country_id">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('state.country_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ $employee ? __('Update') : __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
