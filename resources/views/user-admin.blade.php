<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Administration') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                @livewire('user-admin')
            </div>
        </div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                <h3 class="text-xl font-bold mt-8 mb-4">Lista de Usuarios</h3>
                <ul>
                    @foreach($users as $user)
                    <li>{{ $user->name }} ({{ $user->email }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>