<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $apartment['image_url'] }}" alt="{{ $apartment['title'] }}" 
                                 class="w-full h-96 object-cover rounded-lg">
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $apartment['title'] }}</h1>
                            <p class="text-gray-600 mb-4">{{ $apartment['location'] }}</p>
                            <div class="border-t border-gray-200 py-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Prix par nuit</span>
                                    <span class="text-2xl font-bold text-indigo-600">{{ $apartment['price'] }}€</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-gray-600">Chambres</span>
                                    <span class="text-gray-900">{{ $apartment['bedrooms'] }}</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-gray-600">Type</span>
                                    <span class="text-gray-900 capitalize">{{ $apartment['type'] }}</span>
                                </div>

                                <!-- Équipements -->
                                <div class="mt-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Équipements</h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        @foreach($apartment['equipments'] as $equipment => $available)
                                            <div class="flex items-center space-x-2 {{ $available ? 'text-gray-900' : 'text-gray-400' }}">
                                                @if($available)
                                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                @endif
                                                <span>{{ ucfirst(str_replace('_', ' ', $equipment)) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button class="w-full bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                    Réserver maintenant
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
