<x-form-section submit="addUser">
    <x-slot name="title">
        {{ __('User Administration') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage users') }}
    </x-slot>

    <x-slot name="form">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" required autofocus autocomplete="name" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="email" required autocomplete="username" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="password" required autocomplete="new-password" />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('User added.') }}
        </x-action-message>

        <x-button>
            {{ __('Add User') }}
        </x-button>
    </x-slot>
</x-form-section>
