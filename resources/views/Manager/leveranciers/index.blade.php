<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Leveranciers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Leveranciers Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Naam
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contactpersoon
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Leveranciernummer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mobiel
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Leverancier Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($leveranciers as $leverancier)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $leverancier->Naam }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $leverancier->ContactPersoon }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $leverancier->LeverancierNummer }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $leverancier->Mobiel }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('leveranciers.show', $leverancier->Id) }}" 
                                               class="text-indigo-600 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Geen leveranciers gevonden.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(isset($pagination) && $pagination['last_page'] > 1)
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Toont {{ $pagination['from'] }} tot {{ $pagination['to'] }} van {{ $pagination['total'] }} resultaten
                            </div>
                            <div class="flex space-x-2">
                                @if($pagination['prev_page'])
                                    <a href="{{ route('leveranciers.index', ['page' => $pagination['prev_page']]) }}" 
                                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        Vorige
                                    </a>
                                @endif

                                @for($i = 1; $i <= $pagination['last_page']; $i++)
                                    <a href="{{ route('leveranciers.index', ['page' => $i]) }}" 
                                       class="px-4 py-2 text-sm font-medium {{ $i == $pagination['current_page'] ? 'text-white bg-indigo-600' : 'text-gray-700 bg-white' }} border border-gray-300 rounded-md hover:bg-gray-50">
                                        {{ $i }}
                                    </a>
                                @endfor

                                @if($pagination['next_page'])
                                    <a href="{{ route('leveranciers.index', ['page' => $pagination['next_page']]) }}" 
                                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        Volgende
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Back to Home Button -->
                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
