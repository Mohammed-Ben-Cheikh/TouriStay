<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Modifier la propriété</h1>
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('hébergements.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $property->description) }}</textarea>
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Emplacement</label>
                                <input type="text" name="location" id="location" value="{{ old('location', $property->location) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Prix par nuit (€)</label>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $property->price) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                @if($property->image_url)
                                    <div class="mt-2 mb-4">
                                        <img src="{{ $property->image_url }}" alt="{{ $property->title }}" class="w-32 h-32 object-cover rounded">
                                    </div>
                                @endif
                                <input type="file" name="image" id="image" class="mt-1 block w-full">
                                <p class="text-xs text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle</p>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex items-center justify-end">
                            <a href="{{ route('owner.properties') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
