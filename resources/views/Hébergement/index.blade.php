<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Sidebar avec filtres -->
                            <div class="w-full md:w-80 flex-shrink-0 ">
                                <div class="bg-white p-4 rounded-lg shadow sticky top-6 h-[80vh] overflow-y-auto">
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Filtres</h2>
                                    <form action="{{ route('hébergements.index') }}" method="GET" class="space-y-4">
                                        <!-- Type de logement -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Type de logement</label>
                                            <select name="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="">Tous les types</option>
                                                @foreach([
                                                    'apartment' => 'Appartement',
                                                    'house' => 'Maison',
                                                    'studio' => 'Studio'
                                                ] as $value => $label)
                                                    <option value="{{ $value }}" {{ request('type') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Pays -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                                            <select name="country" id="country-select" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="">Tous les pays</option>
                                                @foreach($citiesByCountry as $country => $cities)
                                                    <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                                                        {{ $country }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Ville -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                                            <select name="city" id="city-select" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="">Toutes les villes</option>
                                            </select>
                                        </div>
                                        <!-- Prix -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Prix par nuit</label>
                                            <select name="price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="">Tous les prix</option>
                                                @foreach([
                                                    '0-50' => '0€ - 50€',
                                                    '51-100' => '51€ - 100€',
                                                    '101-200' => '101€ - 200€',
                                                    '201+' => '201€ et plus'
                                                ] as $value => $label)
                                                    <option value="{{ $value }}" {{ request('price') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
            
                                        <!-- Chambres -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Chambres</label>
                                            <select name="bedrooms" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <option value="">Toutes les tailles</option>
                                                @foreach([1, 2, 3, '4+'] as $bedroom)
                                                    <option value="{{ $bedroom }}" {{ request('bedrooms') == $bedroom ? 'selected' : '' }}>
                                                        {{ $bedroom }} {{ $bedroom == '4+' ? 'ou plus' : ($bedroom > 1 ? 'chambres' : 'chambre') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Équipements -->
                                        <div class="border-t pt-4">
                                            <h3 class="text-sm font-medium text-gray-900 mb-2">Équipements</h3>
                                            <div class="space-y-2">
                                                @foreach([
                                                    'wifi' => 'Wi-Fi',
                                                    'parking' => 'Parking',
                                                    'kitchen' => 'Cuisine',
                                                    'tv' => 'TV',
                                                    'aircon' => 'Climatisation',
                                                    'pool' => 'Piscine',
                                                    'washing_machine' => 'Lave-linge',
                                                    'elevator' => 'Ascenseur'
                                                ] as $value => $label)
                                                    <label class="flex items-center">
                                                        <input type="checkbox" 
                                                               name="equipments[]" 
                                                               value="{{ $value }}" 
                                                               {{ in_array($value, (array)request('equipments')) ? 'checked' : '' }}
                                                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                        <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
            
                                        <div class="pt-4">
                                            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                                Appliquer les filtres
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
            
                            <!-- Liste des appartements -->
                            <div class="flex-grow">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    @foreach($apartments as $apartment)
                                    <div class="bg-white rounded-lg shadow overflow-hidden">
                                        <div class="relative">
                                            <img src="{{ $apartment['primaryImage']['image_url'] }}" alt="{{ $apartment['title'] }}" class="w-full h-48 object-cover">
                                            <form method="POST" action="{{ route('favorites.toggle', $apartment['id']) }}" class="absolute top-2 right-2">
                                                @csrf
                                                <button type="submit" class="p-2 bg-white rounded-full shadow-md hover:bg-gray-100 focus:outline-none">
                                                    @auth
                                                        @if($apartment['isFavorited'])
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-500">
                                                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                            </svg>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('login') }}" class="text-gray-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                            </svg>
                                                        </a>
                                                    @endauth
                                                </button>
                                            </form>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $apartment['title'] }}</h3>
                                            <p class="text-gray-600">{{ $apartment['location'] }}</p>
                                            <div class="mt-2 flex items-center justify-between">
                                                <span class="text-indigo-600 font-bold">{{ $apartment['price'] }}€ /nuit</span>
                                                <span class="text-sm text-gray-500">{{ $apartment['bedrooms'] }} chambres</span>
                                            </div>
                                            <a href="{{ route('hébergements.show', $apartment['id']) }}" class="mt-4 block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                                Voir les détails
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $apartments->links() }}
                        </div>
                        </div>
                    </div>
                </div>
            
                <div id="cities-data" 
                     data-cities="{{ json_encode($citiesByCountry) }}"
                     data-selected-city="{{ request('city') }}">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/city-filter.js') }}"></script>
</x-app-layout>
