<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <h1>Politique de confidentialité</h1>
                <p>Dernière mise à jour: {{ date('d/m/Y') }}</p>

                <h2>1. Collecte des informations</h2>
                <p>Nous collectons les informations que vous nous fournissez directement lorsque vous :</p>
                <ul>
                    <li>Créez un compte</li>
                    <li>Effectuez une réservation</li>
                    <li>Contactez notre service client</li>
                    <li>Remplissez des formulaires</li>
                </ul>

                <h2>2. Utilisation des données</h2>
                <p>Vos informations sont utilisées pour :</p>
                <ul>
                    <li>Gérer votre compte</li>
                    <li>Traiter vos réservations</li>
                    <li>Améliorer nos services</li>
                    <li>Communiquer avec vous</li>
                </ul>

                <h2>3. Protection des données</h2>
                <p>Nous mettons en œuvre des mesures de sécurité pour protéger vos informations personnelles.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
