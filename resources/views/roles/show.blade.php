<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gebruiker Details') }}
            </h2>
            <a href="{{ route('roles.index') }}"
                class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Terug
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Naam
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                {{ $user->name }}
                            </p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                E-mail
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                {{ $user->email }}
                            </p>
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Rol
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ ucfirst($user->rolename) }}
                                </span>
                            </p>
                        </div>

                        <!-- Created At -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Aangemaakt op
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                {{ $user->created_at ? $user->created_at->format('d-m-Y H:i') : 'Onbekend' }}
                            </p>
                        </div>

                        <!-- Updated At -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Laatst bijgewerkt op
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                {{ $user->updated_at ? $user->updated_at->format('d-m-Y H:i') : 'Onbekend' }}
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4 mt-6">
                            <a href="{{ route('roles.edit', $user) }}"
                                class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Rol Wijzigen
                            </a>

                            <form method="POST" action="{{ route('roles.destroy', $user) }}"
                                style="display: inline;"
                                onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
