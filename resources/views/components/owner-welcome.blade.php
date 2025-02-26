<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Hero Section with Background -->
                <div class="relative bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                        <div class="text-center">
                            <h1 class="text-5xl font-extrabold tracking-tight mb-4">Devenez propriétaire sur TouriStay
                            </h1>
                            <p class="text-xl max-w-2xl mx-auto mb-8">Transformez votre propriété en source de revenus
                                et rejoignez
                                notre communauté de propriétaires de confiance</p>
                            <div class="flex justify-center space-x-4">
                                <form method="POST" action="{{ route('register.owner') }}" x-data>
                                    @csrf

                                    <x-dropdown-link
                                        class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 transform hover:scale-105 transition-all duration-200"
                                        href="{{ route('register.owner') }}" @click.prevent="$root.submit();">
                                        {{ __('Commencer maintenant') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="bg-white py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                            <div class="p-6 bg-gray-50 rounded-lg hover:shadow-lg transition-shadow duration-300">
                                <div class="text-4xl font-bold text-blue-600 mb-2">5M+</div>
                                <div class="text-gray-600">Voyageurs actifs</div>
                            </div>
                            <div class="p-6 bg-gray-50 rounded-lg hover:shadow-lg transition-shadow duration-300">
                                <div class="text-4xl font-bold text-blue-600 mb-2">150+</div>
                                <div class="text-gray-600">Pays desservis</div>
                            </div>
                            <div class="p-6 bg-gray-50 rounded-lg hover:shadow-lg transition-shadow duration-300">
                                <div class="text-4xl font-bold text-blue-600 mb-2">€2500</div>
                                <div class="text-gray-600">Revenu mensuel moyen</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Benefits Section with hover effects -->
                <div class="py-16 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold text-center mb-12">Pourquoi nous choisir ?</h2>
                        <div class="grid md:grid-cols-3 gap-8">
                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                                <div class="text-blue-600 mb-4">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Revenus Supplémentaires</h3>
                                <p class="text-gray-600">Gagnez un revenu complémentaire en louant votre propriété quand
                                    vous le
                                    souhaitez.</p>
                            </div>

                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                                <div class="text-blue-600 mb-4">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Gestion Sécurisée</h3>
                                <p class="text-gray-600">Profitez de notre système de réservation sécurisé et de notre
                                    assurance hôte.
                                </p>
                            </div>

                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                                <div class="text-blue-600 mb-4">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Support Dédié</h3>
                                <p class="text-gray-600">Une équipe dédiée pour vous accompagner à chaque étape.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Section -->
                <div class="py-16 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold text-center mb-12">Ce que disent nos propriétaires</h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <div
                                class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="flex items-center mb-4">
                                    <img class="h-12 w-12 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="Testimonial avatar">
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold">Jean Dupont</h4>
                                        <p class="text-gray-600">Propriétaire depuis 2021</p>
                                    </div>
                                </div>
                                <p class="text-gray-600">"TouriStay m'a permis de rentabiliser mon appartement tout en
                                    gardant un
                                    contrôle total sur ma propriété."</p>
                            </div>
                            <!-- Add more testimonials... -->
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="py-16 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold text-center mb-12">Questions fréquentes</h2>
                        <div class="space-y-4 max-w-3xl mx-auto">
                            <div x-data="{ open: false }" class="border-b border-gray-200">
                                <button @click="open = !open"
                                    class="flex justify-between items-center w-full py-4 text-left">
                                    <span class="text-lg font-medium">Comment fonctionne le système de paiement ?</span>
                                    <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 15l7-7 7 7" />
                                    </svg>
                                </button>
                                <div x-show="open" class="pb-4">
                                    <p class="text-gray-600">Nous gérons tous les paiements de manière sécurisée. Les
                                        paiements sont
                                        versés 24h après l'arrivée du voyageur.</p>
                                </div>
                            </div>
                            <!-- Add more FAQ items... -->
                        </div>
                    </div>
                </div>

                <!-- CTA Section with gradient background -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold text-white mb-8">Prêt à commencer votre aventure ?</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>