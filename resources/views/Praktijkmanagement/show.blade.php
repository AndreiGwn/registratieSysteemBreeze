<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Gebruiker Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>ID:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $user->id }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Naam:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Gebruikersrol:</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge bg-info text-dark">{{ $user->rolename }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Aangemaakt op:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y H:i:s') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Laatst gewijzigd:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::parse($user->updated_at)->format('d-m-Y H:i:s') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Email geverifieerd:</strong>
                            </div>
                            <div class="col-md-8">
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">Ja - {{ \Carbon\Carbon::parse($user->email_verified_at)->format('d-m-Y H:i:s') }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">Nee</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('praktijkmanagement.userroles') }}" class="btn btn-secondary">
                            Terug naar Overzicht
                        </a>
                        <a href="{{ route('praktijkmanagement.edit', $user->id) }}" class="btn btn-success">
                            Wijzig Gebruiker
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
