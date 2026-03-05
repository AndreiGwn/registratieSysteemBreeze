<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rollen Beheer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left">
                        <thead class="border-b border-gray-300">
                            <tr>
                                <th class="pb-3">Naam</th>
                                <th class="pb-3">E-mail</th>
                                <th class="pb-3">Rol</th>
                                <th class="pb-3">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3">{{ $user->name }}</td>
                                    <td class="py-3">{{ $user->email }}</td>
                                    <td class="py-3">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                            {{ ucfirst($user->rolename) }}
                                        </span>
                                    </td>
                                    <td class="py-3 space-x-2">
                                        <!-- Details Button -->
                                        <a href="{{ route('roles.show', $user) }}"
                                            class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                            Details
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('roles.edit', $user) }}"
                                            class="inline-block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                            Wijzigen
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST" action="{{ route('roles.destroy', $user) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                                Verwijderen
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-3 text-center text-gray-500">
                                        Geen gebruikers gevonden.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
