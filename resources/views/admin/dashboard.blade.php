<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Bienvenue sur votre tableau de bord propriétaire
                    </div>
                    <div class="mt-6 text-gray-500">
                        Gérez vos propriétés et suivez vos performances en temps réel.
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Propriétés</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">
                            {{ $stats['total_properties'] }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Annonces Actives</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">
                            {{ $stats['active_listings'] }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Réservations Totales</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">
                            {{ $stats['total_bookings'] }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Revenu Total</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">
                            {{ number_format($stats['total_revenue'], 2) }}€
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Properties -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Vos Propriétés Récentes</h2>
                        <a href="{{ route('hébergements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Ajouter une propriété
                        </a>
                    </div>

                    @if($properties->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Propriété
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Statut
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prix/Nuit
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($properties as $property)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($property->primaryImage->image_url)
                                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($property->primaryImage->image_url) }}" alt="">
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $property->title }}
                                                        </div>
                                                        <div class="flex text-sm text-gray-500">
                                                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/>
                                                            </svg>
                                                            {{ $property->location }}, {{ $property->city }}, {{ $property->country }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $property->is_available ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $property->is_available ? 'Disponible' : 'Indisponible' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format($property->price, 2) }}€
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('hébergements.show', $property->id) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                                <a href="{{ route('hébergements.edit', $property->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Modifier</a>
                                                <form action="{{ route('admin.hébergements.destroy', $property->id) }}" method="POST" class="inline-block ml-4">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette propriété ?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500">Vous n'avez pas encore de propriétés.</p>
                            <a href="{{ route('hébergements.create') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                                Commencer par ajouter une propriété
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
