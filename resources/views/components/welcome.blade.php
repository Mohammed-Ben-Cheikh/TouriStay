<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Bienvenue sur TouriStay
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Découvrez notre sélection d'appartements disponibles pour votre prochain séjour.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 lg:p-8">
    <!-- Appartement 1 -->
    @foreach ($property as $prop)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="relative">
                <img src="{{ $prop->primaryImage?->image_url ?? 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267' }}" 
                    alt="{{ $prop->title }}"
                    class="w-full h-48 object-cover">
                <span class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-md text-sm">
                    {{ $prop->is_available ? 'Disponible' : 'Non disponible' }}
                </span>
            </div>
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-900">{{ $prop->title }}</h3>
                <p class="mt-2 text-gray-600">{{ Str::limit($prop->description, 100) }}</p>

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        {{ $prop->bedrooms }} chambres
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        {{ $prop->max_guests ?? 4 }} personnes
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <span class="text-lg font-bold text-indigo-600">{{ number_format($prop->price, 2) }}€/nuit</span>
                        <span class="text-sm text-gray-500 block">Min. {{ $prop->minimum_nights ?? 1 }} nuits</span>
                    </div>
                    @if($prop->rating)
                    <div class="flex items-center bg-yellow-100 px-2 py-1 rounded">
                        <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-sm font-semibold">{{ $prop->rating }} ({{ $prop->reviews_count }} avis)</span>
                    </div>
                    @endif
                </div>

                @if($prop->equipments)
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($prop->equipments as $equipment)
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $equipment }}</span>
                    @endforeach
                </div>
                @endif

                <!-- Boutons -->
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <a href="#"
                        class="text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                        Réserver
                    </a>
                    <a href="#"
                        class="text-center border border-indigo-600 text-indigo-600 py-2 px-4 rounded-md hover:bg-indigo-50 transition">
                        Détails
                    </a>
                </div>

                <!-- Disponibilité -->
                <div class="mt-4 text-sm text-gray-500">
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Prochaine disponibilité: 25 Mai - 15 Juin
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Galerie des Pays -->
<div class="mt-12 p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Découvrez par Pays</h2>
        <div class="flex gap-2">
            <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200" id="prevCountry">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200" id="nextCountry">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- France -->
        <div class="group relative rounded-xl overflow-hidden cursor-pointer transform transition hover:scale-105">
            <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34" alt="France"
                class="w-full h-64 object-cover">
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent group-hover:from-black/90">
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-2xl font-bold text-white mb-2">France</h3>
                    <div class="flex justify-between items-center text-white/90">
                        <span>420 propriétés</span>
                        <span class="bg-white/20 px-3 py-1 rounded-full text-sm">À partir de 85€</span>
                    </div>
                    <div class="mt-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Paris</span>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Lyon</span>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Marseille</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Espagne -->
        <div class="group relative rounded-xl overflow-hidden cursor-pointer transform transition hover:scale-105">
            <img src="https://images.unsplash.com/photo-1543783207-ec64e4d95325" alt="Espagne"
                class="w-full h-64 object-cover">
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent group-hover:from-black/90">
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-2xl font-bold text-white mb-2">Espagne</h3>
                    <div class="flex justify-between items-center text-white/90">
                        <span>320 propriétés</span>
                        <span class="bg-white/20 px-3 py-1 rounded-full text-sm">À partir de 75€</span>
                    </div>
                    <div class="mt-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Madrid</span>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Barcelone</span>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Séville</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Galerie des Villes -->
<div class="p-6 lg:p-8 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Villes en Tendance</h2>
        <div class="flex gap-4">
            <button class="text-sm font-medium text-gray-600 hover:text-indigo-600" data-filter="all">Toutes</button>
            <button class="text-sm font-medium text-gray-600 hover:text-indigo-600" data-filter="france">France</button>
            <button class="text-sm font-medium text-gray-600 hover:text-indigo-600" data-filter="spain">Espagne</button>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Paris -->
        <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267" alt="Paris"
                    class="w-full h-40 object-cover">
                <div class="absolute top-2 right-2 bg-white/90 px-2 py-1 rounded-full text-xs font-medium">
                    150 locations
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-gray-900">Paris</h3>
                        <p class="text-sm text-gray-600">France</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1 text-sm text-gray-600">4.8</span>
                    </div>
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Culture</span>
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">Gastronomie</span>
                </div>
            </div>
        </div>
        <!-- Ajoutez plus de villes avec le même format -->
    </div>

    <div class="mt-8 text-center">
        <button class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            Voir plus de villes
        </button>
    </div>
</div>

<!-- Section Blog -->
<div class="p-6 lg:p-8 bg-white">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Derniers Articles Blog</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <article class="rounded-lg overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" alt="Blog post"
                class="w-full h-48 object-cover">
            <div class="p-4">
                <span class="text-indigo-600 text-sm font-semibold">Conseils Voyage</span>
                <h3 class="mt-2 text-xl font-semibold">Les meilleurs quartiers de Paris</h3>
                <p class="mt-2 text-gray-600 text-sm">Découvrez les quartiers les plus authentiques de Paris pour votre
                    prochain séjour...</p>
                <a href="#" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-700">
                    Lire plus
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </article>
        <!-- Plus d'articles... -->
    </div>
</div>

<!-- Section Avis Clients -->
<div class="p-6 lg:p-8 bg-gray-50">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ce que disent nos clients</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center mb-4">
                <img src="https://i.pravatar.cc/60?img=1" alt="Avatar" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <h4 class="font-semibold">Marie Dupont</h4>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-sm text-gray-600 ml-1">5.0</span>
                    </div>
                </div>
            </div>
            <p class="text-gray-600">"Séjour parfait ! L'appartement était exactement comme sur les photos..."</p>
        </div>
        <!-- Plus d'avis... -->
    </div>
</div>

<!-- Section Newsletter -->
<div class="p-6 lg:p-8 bg-indigo-600 text-white">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">Restez informé des meilleures offres</h2>
        <p class="mb-6">Inscrivez-vous à notre newsletter pour recevoir nos meilleures offres</p>
        <form class="flex gap-2 max-w-md mx-auto">
            <input type="email" placeholder="Votre email" class="flex-1 px-4 py-2 rounded-md text-gray-900">
            <button type="submit" class="px-6 py-2 bg-white text-indigo-600 font-semibold rounded-md hover:bg-gray-100">
                S'inscrire
            </button>
        </form>
    </div>
</div>