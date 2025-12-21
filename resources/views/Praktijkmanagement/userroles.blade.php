<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container d-flex justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3">{{ $title }}</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
                    </div>
                    <meta http-equiv="refresh" content="3;url={{ route('praktijkmanagement.userroles') }}">
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
                    </div>
                    <meta http-equiv="refresh" content="3;url={{ route('praktijkmanagement.userroles') }}">
                @endif

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Naam</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gebruikersrol</th>
                            <th scope="col">Verwijder</th>
                            <th scope="col">Wijzig</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->rolename }}</td>
                            <td>
                                <form method="POST" action="{{ route('praktijkmanagement.destroy', $user->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Weet u zeker dat u deze gebruiker wilt verwijderen?')">
                                        Verwijderen
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('praktijkmanagement.edit', $user->id) }}" class="btn btn-success">
                                    Wijzig
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('praktijkmanagement.show', ['id' => $user->id]) }}" class="btn btn-warning">
                                    Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Geen gebruikers gevonden.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
