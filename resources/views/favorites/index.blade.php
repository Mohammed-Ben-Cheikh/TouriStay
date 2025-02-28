<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Mes Favoris</h2>
                    @if($favorites->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($favorites as $favorite)
                                @if($favorite && $favorite->primaryImage->image_url)
                                    <div class="bg-white rounded-lg shadow overflow-hidden">
                                        <div class="relative">
                                            <img src="{{ $favorite->primaryImage->image_url }}" alt="{{ $favorite->title }}"
                                                class="w-full h-48 object-cover">
                                            <form method="POST" action="{{ route('favorites.toggle', $favorite->id) }}"
                                                class="absolute top-2 right-2">
                                                @csrf
                                                <button type="submit" class="p-2 bg-white rounded-full shadow-md hover:bg-gray-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                        class="w-6 h-6 text-red-500">
                                                        <path
                                                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $favorite->title }}</h3>
                                            <p class="text-gray-600">{{ $favorite->location }}</p>
                                            <div class="mt-2 flex items-center justify-between">
                                                <span class="text-indigo-600 font-bold">{{ $favorite->price }}€
                                                    /nuit</span>
                                                <span class="text-sm text-gray-500">{{ $favorite->bedrooms }}
                                                    chambres</span>
                                            </div>
                                            <a href="{{ route('hébergements.show', $favorite->id) }}"
                                                class="mt-4 block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                                Voir les détails
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $favorites->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500">Vous n'avez pas encore de favoris</p>
                            <a href="{{ route('hébergements.index') }}"
                                class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                                Découvrir des hébergements
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>