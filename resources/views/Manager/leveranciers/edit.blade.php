<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wijzig Leveranciergegevens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form method="POST" action="{{ route('leveranciers.update', $leverancier->Id) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <!-- Naam -->
                            <div>
                                <label for="naam" class="block text-sm font-medium text-gray-700">
                                    Naam:
                                </label>
                                <input type="text" 
                                       name="naam" 
                                       id="naam" 
                                       value="{{ old('naam', $leverancier->Naam) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Contactpersoon -->
                            <div>
                                <label for="contactpersoon" class="block text-sm font-medium text-gray-700">
                                    Contactpersoon:
                                </label>
                                <input type="text" 
                                       name="contactpersoon" 
                                       id="contactpersoon" 
                                       value="{{ old('contactpersoon', $leverancier->ContactPersoon) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Leveranciernummer -->
                            <div>
                                <label for="leveranciernummer" class="block text-sm font-medium text-gray-700">
                                    Leveranciernummer:
                                </label>
                                <input type="text" 
                                       name="leveranciernummer" 
                                       id="leveranciernummer" 
                                       value="{{ old('leveranciernummer', $leverancier->LeverancierNummer) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Mobiel -->
                            <div>
                                <label for="mobiel" class="block text-sm font-medium text-gray-700">
                                    Mobiel:
                                </label>
                                <input type="text" 
                                       name="mobiel" 
                                       id="mobiel" 
                                       value="{{ old('mobiel', $leverancier->Mobiel) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Straatnaam -->
                            <div>
                                <label for="straat" class="block text-sm font-medium text-gray-700">
                                    Straatnaam:
                                </label>
                                <input type="text" 
                                       name="straat" 
                                       id="straat" 
                                       value="{{ old('straat', $leverancier->Straat) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Huisnummer -->
                            <div>
                                <label for="huisnummer" class="block text-sm font-medium text-gray-700">
                                    Huisnummer:
                                </label>
                                <input type="text" 
                                       name="huisnummer" 
                                       id="huisnummer" 
                                       value="{{ old('huisnummer', $leverancier->Huisnummer) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Postcode -->
                            <div>
                                <label for="postcode" class="block text-sm font-medium text-gray-700">
                                    Postcode:
                                </label>
                                <input type="text" 
                                       name="postcode" 
                                       id="postcode" 
                                       value="{{ old('postcode', $leverancier->Postcode) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Stad -->
                            <div>
                                <label for="stad" class="block text-sm font-medium text-gray-700">
                                    Stad:
                                </label>
                                <input type="text" 
                                       name="stad" 
                                       id="stad" 
                                       value="{{ old('stad', $leverancier->Stad) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Buttons -->
                            <div class="flex space-x-4 mt-6">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Sla Op
                                </button>
                                
                                <a href="{{ route('leveranciers.show', $leverancier->Id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Terug
                                </a>

                                <a href="{{ route('dashboard') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    Home
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
