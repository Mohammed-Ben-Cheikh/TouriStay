<x-app-layout>
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
                                    @foreach(['Maroc', 'Portugal','Espagne','Uruguay','Paraguay','Paraguay'] as $country)
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
                        {{-- @php
                            dd($apartment);
                        @endphp --}}
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="{{ $apartment['primaryImage']['image_url'] }}" alt="{{ $apartment['title'] }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $apartment['title'] }}</h3>
                                <p class="text-gray-600">{{ $apartment['location'] }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-indigo-600 font-bold">{{ $apartment['price'] }}€ /nuit</span>
                                    <span class="text-sm text-gray-500">{{ $apartment['bedrooms'] }} chambres</span>
                                </div>
                                <a href="{{ route('Hébergements.show', $apartment['id']) }}" class="mt-4 block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
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

    <script src="{{ asset('js/city-filter.js') }}"></script>
</x-app-layout>
