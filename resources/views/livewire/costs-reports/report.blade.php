<div>
    <x-form-section submit="generateReport">
        <x-slot name="title">
            {{ __('Status Files') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Generate reports based on year, month, or company.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <ul class="flex border-b">
                    <li class="-mb-px mr-1">
                        <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#year-month" onclick="showTab('year-month')">By Year and Month</a>
                    </li>
                    <li class="mr-1">
                        <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#company" onclick="showTab('company')">By Company</a>
                    </li>
                </ul>
                <div id="year-month" class="tab-content">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="year" value="{{ __('Year') }}" />
                        <select id="year" class="mt-1 block w-full" wire:model="year">
                            @for ($i = 2010; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="month" value="{{ __('Month') }}" />
                        <select id="month" class="mt-1 block w-full" wire:model="month">
                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $index => $month)
                                <option value="{{ $index + 1 }}">{{ $month }}</option>
                            @endforeach
                        </select>
                        @error('month') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div id="company" class="tab-content hidden">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="company" value="{{ __('Company') }}" />
                        <select id="company" class="mt-1 block w-full" wire:model="company">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('company') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button class="btn-primary">
                {{ __('Generate Report') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>

<script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        document.getElementById(tabId).classList.remove('hidden');
    }
</script>
