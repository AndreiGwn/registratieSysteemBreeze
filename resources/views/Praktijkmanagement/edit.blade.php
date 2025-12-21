<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Fout!</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('praktijkmanagement.update', $user->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="InputName" class="block font-medium text-sm text-gray-700">
                                Naam
                            </label>
                            <input name="name" 
                                   type="text" 
                                   id="InputName" 
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label for="InputDescription" class="block font-medium text-sm text-gray-700">
                                Email
                            </label>
                            <input name="email" 
                                   type="email" 
                                   id="InputDescription" 
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label for="InputRolename" class="block font-medium text-sm text-gray-700">
                                Gebruikersrol
                            </label>
                            <select name="rolename" 
                                    id="InputRolename"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($userroles as $userrole)
                                    <option value="{{ $userrole->rolename }}" @selected($userrole->rolename == $user->rolename)>
                                        {{ ucfirst($userrole->rolename) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Opslaan
                            </button>
                            <a href="{{ route('praktijkmanagement.userroles') }}" 
                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
