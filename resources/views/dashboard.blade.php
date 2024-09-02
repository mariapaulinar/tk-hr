<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-9xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('employee-stats')
            </div>
        </div>
    </div>
</x-app-layout>
