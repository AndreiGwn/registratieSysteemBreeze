<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rol Wijzigen: ' . $user->name) }}
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
                    <form method="POST" action="{{ route('roles.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <!-- User Info (Read-only) -->
                        <div class="mb-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Naam
                                </label>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    E-mail
                                </label>
                                <p class="text-gray-900 bg-gray-50 p-3 rounded">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-6">
                            <label for="rolename" class="block text-sm font-medium text-gray-700 mb-2">
                                Selecteer nieuwe rol *
                            </label>
                            <select name="rolename" id="rolename"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                                <option value="">-- Kies een rol --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        {{ $user->rolename === $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rolename')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Role -->
                        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <p class="text-sm text-gray-700">
                                <strong>Huidige rol:</strong>
                                <span class="ml-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ ucfirst($user->rolename) }}
                                </span>
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4">
                            <button type="submit"
                                class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Opslaan
                            </button>
                            <a href="{{ route('roles.index') }}"
                                class="inline-block px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
