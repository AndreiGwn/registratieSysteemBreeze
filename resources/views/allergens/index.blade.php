<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Allergenen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Filter op Allergeen</h3>
                    
                    <form method="GET" action="{{ route('allergens.index') }}" class="flex gap-4">
                        <div class="flex-1">
                            <select name="allergen_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Alle productenclusief allergen --</option>
                                @foreach ($allergens as $allergen)
                                    <option value="{{ $allergen->id }}" {{ $selectedAllergen == $allergen->id ? 'selected' : '' }}>
                                        {{ $allergen->naam }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Maak Selectie
                        </button>
                        @if ($selectedAllergen)
                            <a href="{{ route('allergens.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($selectedAllergen)
                        <p class="mb-4 text-sm text-gray-600">
                            Filtering op allergen: <strong>{{ $allergens->find($selectedAllergen)->naam ?? 'N/A' }}</strong>
                        </p>
                    @endif

                    <table class="w-full text-left">
                        <thead class="border-b border-gray-300">
                            <tr>
                                <th class="pb-3">Naam Product</th>
                                <th class="pb-3">Naam Allergeen</th>
                                <th class="pb-3">Omschrijving</th>
                                <th class="pb-3">Aantal Aanwezig</th>
                                <th class="pb-3">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3">{{ $product->naam }}</td>
                                    <td class="py-3">
                                        <div class="flex flex-col gap-1">
                                            @foreach ($product->allergens as $allergen)
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs self-start">
                                                    {{ $allergen->naam }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-3 text-sm text-gray-600">
                                        <div class="flex flex-col gap-1">
                                            @foreach ($product->allergens as $allergen)
                                                <span class="py-1">{{ $allergen->omschrijving }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $product->magazine ? $product->magazine->aantal_aanwezig : 0 }}</td>
                                    <td class="py-3">
                                        <a href="{{ route('allergens.supplier', $product) }}" class="text-white bg-blue-500 hover:bg-blue-600 rounded-full w-6 h-6 inline-flex items-center justify-center font-bold font-serif shadow-sm">
                                            ?
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-3 text-center text-gray-500">
                                        Geen producten met allergenen gevonden.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
