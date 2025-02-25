<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('apartments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <x-label for="name" value="{{ __('Property Name') }}" />
                        <x-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                    </div>

                    <div>
                        <x-button>
                            {{ __('Create Property') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
