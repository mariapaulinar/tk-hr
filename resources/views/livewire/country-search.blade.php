<div>
    <input type="text" placeholder="{{ __('Buscar país...') }}" class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="search" />

    @if(!empty($countries))
        <ul class="mt-1 block w-full border-primary-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm">
            @foreach($countries as $country)
                <li wire:click="selectCountry({{ $country->id }})" class="cursor-pointer p-2 hover:bg-gray-200">{{ $country->name }}</li>
            @endforeach
        </ul>
    @endif
</div>
