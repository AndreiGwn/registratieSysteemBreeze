<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Producten van ') }} {{ $leverancier->Naam }}
            </h2>
            <a href="{{ route('leveranciers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Terug naar Overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Supplier Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Leverancier Informatie</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Contactpersoon</p>
                            <p class="font-medium">{{ $leverancier->ContactPersoon }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Leverancier Nummer</p>
                            <p class="font-medium">{{ $leverancier->LeverancierNummer }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Mobiel</p>
                            <p class="font-medium">{{ $leverancier->Mobiel }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Producten</h3>
                    
                    @if(count($products) > 0)
                        <div class="space-y-4">
                            @foreach($products as $product)
                            <div class="border rounded-lg p-4 {{ $product->IsActief ? '' : 'bg-gray-50' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-lg {{ $product->IsActief ? 'text-gray-900' : 'text-gray-500' }}">
                                            {{ $product->Naam }}
                                            @if(!$product->IsActief)
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Niet Actief
                                                </span>
                                            @endif
                                        </h4>
                                        <p class="text-sm text-gray-600 mt-1">Barcode: {{ $product->Barcode }}</p>
                                        
                                        <!-- Allergens -->
                                        @if(count($product->allergenen) > 0)
                                            <div class="mt-3">
                                                <p class="text-sm font-medium text-gray-700 mb-2">Allergenen:</p>
                                                <div class="space-y-1">
                                                    @foreach($product->allergenen as $allergeen)
                                                    <div class="flex items-start bg-yellow-50 border border-yellow-200 rounded p-2">
                                                        <svg class="w-4 h-4 text-yellow-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-900">{{ $allergeen->Naam }}</p>
                                                            <p class="text-xs text-gray-600">{{ $allergeen->Omschrijving }}</p>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-500 mt-2">Geen allergenen</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- US01 Scenario 02: No products message -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Deze leverancier heeft op dit moment geen producten.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
