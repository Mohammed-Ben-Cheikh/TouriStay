<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Add New Property</h1>

        <form id="propertyForm" action="{{ route('hébergements.store') }}" method="POST" class="space-y-6"
            enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-md">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                    required>{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Country</label>
                    <select id="country-select" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        <option value="">Select a Country</option>
                        @foreach($citiesByCountry as $country => $cities)
                            <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <select name="ville_id" id="city-select" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select a City</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                        <option value="">Select type</option>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="villa">Villa</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price per night</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Number of bedrooms</label>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" min="1" max="20"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Maximum Guests</label>
                    <input type="number" name="max_guests" value="{{ old('max_guests') }}" min="1"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Minimum Nights</label>
                    <input type="number" name="minimum_nights" value="{{ old('minimum_nights') }}" min="1"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Availability Period</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Available From</label>
                        <input type="date" name="available_from" value="{{ old('available_from') }}"
                            min="{{ date('Y-m-d') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Available Until</label>
                        <input type="date" name="available_until" value="{{ old('available_until') }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Specify the period when your property will be available for
                    booking.</p>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700">Property Images</label>
                <div id="drop-zone"
                    class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-500 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file-upload"
                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                <span>Upload images</span>
                                <input id="file-upload" name="images[]" type="file" multiple class="sr-only"
                                    accept="image/*" onchange="previewImages(this.files)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB each (max 5 images)</p>
                    </div>
                </div>
                <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"></div>

                <!-- Add a hidden input to track deleted images -->
                <input type="hidden" id="deleted-images" name="deleted_images" value="">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Equipments</label>
                <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                    @foreach(['wifi' => 'Wi-Fi', 'parking' => 'Parking', 'kitchen' => 'Cuisine', 'tv' => 'TV', 'aircon' => 'Climatisation', 'pool' => 'Piscine', 'washing_machine' => 'Lave-linge', 'elevator' => 'Ascenseur'] as $key => $label)
                        <label class="flex items-center p-2 bg-white rounded-md shadow-sm">
                            <input type="checkbox" name="equipments[{{ $key }}]" value="1"
                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                Add Property
            </button>
        </form>
        <div id="cities-data" data-cities="{{ json_encode($citiesByCountry) }}"
            data-selected-city="{{ request('city') }}">
        </div>
    </div>
    <script src="{{ asset('js/city-filter.js') }}"></script>
    <script>
        // Handle Drag and Drop
        const dropZone = document.getElementById('drop-zone');
        let currentFiles = []; // Track current files
        const MAX_FILES = 5; // Maximum allowed images

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            // Only highlight if we haven't reached the max
            if (currentFiles.length >= MAX_FILES) {
                e.dataTransfer.dropEffect = 'none'; // Show 'not-allowed' cursor
                return;
            }
            dropZone.classList.add('border-indigo-600', 'bg-indigo-50');
        }

        function unhighlight() {
            dropZone.classList.remove('border-indigo-600', 'bg-indigo-50');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            // Don't process if we've reached the max
            if (currentFiles.length >= MAX_FILES) {
                alert(`Maximum ${MAX_FILES} images allowed`);
                return;
            }

            const dt = e.dataTransfer;
            const droppedFiles = dt.files;

            // Add dropped files to current files
            handleFiles(droppedFiles);
        }

        // Handle the file input change
        document.getElementById('file-upload').addEventListener('change', function () {
            handleFiles(this.files);
        });

        // Function to handle files from both drag & drop and file input
        function handleFiles(newFiles) {
            if (currentFiles.length >= MAX_FILES) {
                alert(`Maximum ${MAX_FILES} images allowed`);
                return;
            }

            // Calculate how many more files we can add
            const remainingSlots = MAX_FILES - currentFiles.length;
            let addedCount = 0;

            // Add new files to current files collection
            for (let i = 0; i < newFiles.length && addedCount < remainingSlots; i++) {
                const file = newFiles[i];

                // Vérification plus stricte des types MIME
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Format d\'image non valide. Utilisez JPG, PNG ou GIF.');
                    continue;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('File size should not exceed 2MB');
                    continue;
                }

                currentFiles.push(file);
                addedCount++;
            }

            // Update hidden input with files
            updateFileInput();

            // Preview images
            renderPreviews();

            // Update UI state based on file count
            updateUploadState();
        }

        // Update the file input with current files
        function updateFileInput() {
            const fileInput = document.getElementById('file-upload');
            const dataTransfer = new DataTransfer();

            currentFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
        }

        // Preview Images
        function renderPreviews() {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';

            currentFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = 'relative';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'h-32 w-full object-cover rounded-lg';
                    div.appendChild(img);

                    // Add primary badge to first image
                    if (index === 0) {
                        const badge = document.createElement('span');
                        badge.className = 'absolute top-2 left-2 px-2 py-1 bg-green-500 text-white text-xs rounded-full';
                        badge.textContent = 'Primary';
                        div.appendChild(badge);
                    }

                    // Add delete button
                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = 'button';
                    deleteBtn.className = 'absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full';
                    deleteBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                    deleteBtn.onclick = function () {
                        // Remove from currentFiles
                        currentFiles.splice(index, 1);

                        // Update file input and re-render previews
                        updateFileInput();
                        renderPreviews();

                        // Update upload state
                        updateUploadState();
                    };
                    div.appendChild(deleteBtn);

                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        // Update the state of the upload area based on file count
        function updateUploadState() {
            const fileInput = document.getElementById('file-upload');
            const uploadArea = document.getElementById('drop-zone');
            const uploadLabel = fileInput.parentElement;

            if (currentFiles.length >= MAX_FILES) {
                // Disable and show visual feedback
                uploadArea.classList.add('opacity-50', 'cursor-not-allowed');
                uploadArea.classList.remove('hover:border-indigo-500');
                uploadLabel.classList.add('pointer-events-none');

                // Add a message to show max reached
                const messageEl = document.getElementById('max-files-message') || document.createElement('p');
                messageEl.id = 'max-files-message';
                messageEl.className = 'text-amber-600 text-xs mt-2 font-medium';
                messageEl.textContent = `Maximum ${MAX_FILES} images reached. Delete an image to add another.`;
                if (!document.getElementById('max-files-message')) {
                    uploadArea.parentNode.insertBefore(messageEl, uploadArea.nextSibling);
                }
            } else {
                // Enable and remove visual feedback
                uploadArea.classList.remove('opacity-50', 'cursor-not-allowed');
                uploadArea.classList.add('hover:border-indigo-500');
                uploadLabel.classList.remove('pointer-events-none');

                // Remove the max reached message if it exists
                const messageEl = document.getElementById('max-files-message');
                if (messageEl) {
                    messageEl.remove();
                }
            }
        }

        // Initialize upload state on page load
        document.addEventListener('DOMContentLoaded', updateUploadState);

        // Add date validation
        document.addEventListener('DOMContentLoaded', function () {
            const fromDate = document.querySelector('input[name="available_from"]');
            const untilDate = document.querySelector('input[name="available_until"]');

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            fromDate.min = today;

            fromDate.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const nextDay = new Date(selectedDate);
                nextDay.setDate(nextDay.getDate() + 1);
                untilDate.min = nextDay.toISOString().split('T')[0];

                if (untilDate.value && new Date(untilDate.value) <= selectedDate) {
                    untilDate.value = nextDay.toISOString().split('T')[0];
                }
            });

            // Set maximum date to 2 years from now
            const twoYearsFromNow = new Date();
            twoYearsFromNow.setFullYear(twoYearsFromNow.getFullYear() + 2);
            const maxDate = twoYearsFromNow.toISOString().split('T')[0];
            fromDate.max = maxDate;
            untilDate.max = maxDate;
        });

        // Ajout de la fonction de validation du formulaire
        function validateForm() {
            const form = document.getElementById('propertyForm');
            const fromDate = form.querySelector('input[name="available_from"]');
            const untilDate = form.querySelector('input[name="available_until"]');
            const price = form.querySelector('input[name="price"]');

            if (new Date(fromDate.value) >= new Date(untilDate.value)) {
                alert('La date de fin doit être postérieure à la date de début');
                return false;
            }

            if (parseFloat(price.value) <= 0) {
                alert('Le prix doit être supérieur à 0');
                return false;
            }

            if (currentFiles.length === 0) {
                alert('Veuillez ajouter au moins une image');
                return false;
            }

            return true;
        }
    </script>
</x-app-layout>