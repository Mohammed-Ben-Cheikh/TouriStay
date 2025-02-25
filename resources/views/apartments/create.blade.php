<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Add New Apartment</h1>
    
        <form action="{{ route('apartments.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
    
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
    
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price per night</label>
                    <input type="number" name="price" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-700">Images</label>
                <input type="file" name="images[]" multiple class="mt-1 w-full" accept="image/*">
            </div>
    
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                Add Apartment
            </button>
        </form>
    </div>
</x-app-layout>

