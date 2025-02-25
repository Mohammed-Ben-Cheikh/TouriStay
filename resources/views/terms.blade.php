<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <h1>Conditions Générales d'Utilisation</h1>
                <p>En vigueur au {{ date('d/m/Y') }}</p>

                <h2>1. Acceptation des conditions</h2>
                <p>En accédant à TouriStay, vous acceptez d'être lié par ces conditions.</p>

                <h2>2. Services proposés</h2>
                <p>TouriStay est une plateforme de réservation de logements qui permet :</p>
                <ul>
                    <li>La recherche de logements</li>
                    <li>La réservation en ligne</li>
                    <li>Le paiement sécurisé</li>
                    <li>La communication entre hôtes et voyageurs</li>
                </ul>

                <h2>3. Responsabilités</h2>
                <p>Les utilisateurs sont responsables :</p>
                <ul>
                    <li>De l'exactitude des informations fournies</li>
                    <li>Du respect des règles de la plateforme</li>
                    <li>Du comportement lors des séjours</li>
                </ul>

                <h2>4. Modifications</h2>
                <p>Nous nous réservons le droit de modifier ces conditions à tout moment.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
