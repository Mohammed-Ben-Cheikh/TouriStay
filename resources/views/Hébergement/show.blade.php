<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Image Gallery -->
                    <div class="mb-8">
                        <!-- Thumbnails Above -->
                        <div class="grid grid-cols-4 gap-4 mb-4">
                            @foreach($apartment->images->take(4) as $image)
                                <div class="relative group">
                                    <img src="{{ Storage::url($image->image_url) }}" 
                                         alt="{{ $apartment->title }}"
                                         class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity {{ $image->is_primary ? 'ring-2 ring-indigo-500' : '' }}"
                                         onclick="updateMainImage('{{ Storage::url($image->image_url) }}')">
                                    @if($image->is_primary)
                                        <span class="absolute top-2 left-2 px-2 py-1 bg-indigo-500 text-white text-xs rounded-full">
                                            Primary
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Main Image -->
                        <div class="relative">
                            <img id="mainImage" 
                                 src="{{ Storage::url($apartment->primaryImage->image_url) }}" 
                                 alt="{{ $apartment->title }}"
                                 class="w-full h-[400px] object-cover rounded-lg cursor-pointer"
                                 onclick="openFullscreen(this.src)">
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column - Main Info -->
                        <div class="lg:col-span-2">
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $apartment->title }}</h1>
                            <div class="flex items-center text-gray-600 mb-6">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                <span>{{ $apartment->location }}, {{ $apartment->city }}, {{ $apartment->country }}</span>
                            </div>

                            <div class="prose max-w-none mb-8">
                                <h2 class="text-xl font-semibold mb-4">Description</h2>
                                <p class="text-gray-600">{{ $apartment->description }}</p>
                            </div>

                            <!-- Équipements -->
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold mb-4">Équipements</h2>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach($apartment->equipments as $equipment => $available)
                                        <div class="flex items-center space-x-2 {{ $available ? 'text-gray-900' : 'text-gray-400' }}">
                                            @if($available)
                                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                                </svg>
                                            @endif
                                            <span>{{ ucfirst(str_replace('_', ' ', $equipment)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Booking Card -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm sticky top-6">
                                <div class="mb-4">
                                    <span class="text-3xl font-bold text-indigo-600">{{ $apartment->price }}€</span>
                                    <span class="text-gray-600">/nuit</span>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <span class="block text-sm text-gray-600">Chambres</span>
                                        <span class="block font-semibold">{{ $apartment->bedrooms }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm text-gray-600">Type</span>
                                        <span class="block font-semibold capitalize">{{ $apartment->type }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm text-gray-600">Séjour minimum</span>
                                        <span class="block font-semibold">{{ $apartment->minimum_nights }} nuits</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm text-gray-600">Capacité max.</span>
                                        <span class="block font-semibold">{{ $apartment->max_guests }} personnes</span>
                                    </div>
                                </div>

                                <a href="{{ route('check-in', $apartment['id']) }}" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors">
                                    Voir la disponibilité
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fullscreen Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50" onclick="closeFullscreen()">
        <button class="absolute top-4 right-4 text-white" onclick="closeFullscreen()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="fullscreenImage" class="max-w-[90%] max-h-[90vh] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" src="" alt="Fullscreen view">
    </div>

    <script>
        function updateMainImage(src) {
            document.getElementById('mainImage').src = src;
        }

        function openFullscreen(src) {
            const modal = document.getElementById('imageModal');
            const fullscreenImage = document.getElementById('fullscreenImage');
            fullscreenImage.src = src;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeFullscreen() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFullscreen();
            }
        });
    </script>
</x-app-layout>
