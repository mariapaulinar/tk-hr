<x-form-section submit="import">
    <x-slot name="title">
        {{ __('Import Cost Report') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Upload an Excel or CSV file and provide the required information.') }}
    </x-slot>
    
    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="company" value="{{ __('Company') }}" />
            <select id="company" class="mt-1 block w-full" wire:model="company">
                <option value="">{{ __('Select a company') }}</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            @error('company') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="year" value="{{ __('Year') }}" />
            <x-input id="year" type="number" class="mt-1 block w-full" wire:model.blur="year" />
            @error('year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="month" value="{{ __('Month') }}" />
            <select id="month" class="mt-1 block w-full" wire:model="month">
                <option value="">{{ __('Select a month') }}</option>
                @foreach($months as $m)
                    <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                @endforeach
            </select>
            @error('month') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="file" value="{{ __('Excel or CSV File') }}" />
            <x-input id="file" type="file" class="mt-1 block w-full" wire:model="file" />
            @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    
        <div class="col-span-6 sm:col-span-4">
        @if (session()->has('message'))
            <div class="mt-4 text-green-500 w-full">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-4 text-red-500 w-full">
                {{ __('There was an error importing the file.') }}
            </div>
        @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button class="btn-primary">
            {{ __('Import') }}
        </x-button>
    </x-slot>

</x-form-section>
