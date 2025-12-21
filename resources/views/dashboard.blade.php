<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            @if(auth()->check() && auth()->user()->rolename === 'praktijkmanagement')
            <!-- Gebruikersrollen Beheer Link -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Gebruikersbeheer</h3>
                    <a href="{{ route('praktijkmanagement.userroles') }}" class="btn btn-primary">
                        Verander Roles of Verwijderen
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
