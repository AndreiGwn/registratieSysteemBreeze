<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leverancier Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Success/Error Messages with Auto Redirect -->
                    @if(session('success'))
                        <div id="success-message" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-message').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    @if(session('error'))
                        <div id="error-message" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('error-message').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <!-- Leverancier Details -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Naam</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->Naam }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contactpersoon</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->ContactPersoon }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Leveranciernummer</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->LeverancierNummer }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mobiel</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->Mobiel }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Straatnaam</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->Straat }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Huisnummer</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->Huisnummer }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Postcode</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->Postcode }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stad</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-md">{{ $leverancier->Stad }}</div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-4 mt-6">
                            <a href="{{ route('leveranciers.edit', $leverancier->Id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Wijzig
                            </a>
                            
                            <a href="{{ route('leveranciers.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Terug
                            </a>

                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
