<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Overzicht Leverancier Gegevens: ' . $product->naam) }}
            </h2>
            <a href="{{ route('allergens.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Terug
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Product Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Product Informatie</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Naam</label>
                            <p class="text-gray-900">{{ $product->naam }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Barcode</label>
                            <p class="text-gray-900">{{ $product->barcode }}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Allergenen</label>
                            <div class="flex flex-wrap gap-2">
                                @forelse ($product->allergens as $allergen)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ $allergen->naam }}
                                    </span>
                                @empty
                                    <p class="text-gray-500">Geen allergenen geregistreerd</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suppliers Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Leveranciers</h3>
                    
                    <table class="w-full text-left">
                        <thead class="border-b border-gray-300">
                            <tr>
                                <th class="pb-3">Naam Leverancier</th>
                                <th class="pb-3">Contact Persoon</th>
                                <th class="pb-3">Mobiel</th>
                                <th class="pb-3">Adres</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliers as $supplier)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3">{{ $supplier->naam }}</td>
                                    <td class="py-3">{{ $supplier->contact_persoon }}</td>
                                    <td class="py-3">{{ $supplier->mobiel }}</td>
                                    <td class="py-3">
                                        @if ($supplier->contact)
                                            <span class="text-sm text-gray-700">
                                                {{ $supplier->contact->straat }} {{ $supplier->contact->huisnummer }}<br>
                                                {{ $supplier->contact->postcode }} {{ $supplier->contact->stad }}
                                            </span>
                                        @else
                                            <span class="text-sm text-red-600">
                                                Er is zijn geen adresgegevens bekent
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-gray-500">
                                        Geen leveranciers gevonden voor dit product.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
