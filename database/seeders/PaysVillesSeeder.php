<?php

namespace Database\Seeders;

use App\Models\Pays;
use App\Models\Ville;
use Illuminate\Database\Seeder;

class PaysVillesSeeder extends Seeder
{
    public function run(): void
    {
        $citiesByCountry = [
            'Argentine' => [
                'Buenos Aires' => 'villes/buenos-aires.jpg'
            ],
            'Paraguay' => [
                'Asunción' => 'villes/asuncion.jpg'
            ],
            'Uruguay' => [
                'Montevideo' => 'villes/montevideo.jpg'
            ],
            'Espagne' => [
                'Madrid' => 'villes/madrid.jpg',
                'Barcelone' => 'villes/barcelone.jpg',
                'Séville' => 'villes/seville.jpg',
                'Bilbao' => 'villes/bilbao.jpg',
                'Málaga' => 'villes/malaga.jpg',
                'Saragosse' => 'villes/saragosse.jpg',
                'Las Palmas' => 'villes/las-palmas.jpg',
                'Saint-Sébastien' => 'villes/saint-sebastien.jpg',
                'La Corogne' => 'villes/la-corogne.jpg'
            ],
            'Portugal' => [
                'Lisbonne' => 'villes/lisbonne.jpg',
                'Porto' => 'villes/porto.jpg'
            ],
            'Maroc' => [
                'Casablanca' => 'villes/casablanca.jpg',
                'Rabat' => 'villes/rabat.jpg',
                'Tanger' => 'villes/tanger.jpg',
                'Marrakech' => 'villes/marrakech.jpg',
                'Agadir' => 'villes/agadir.jpg',
                'Fès' => 'villes/fes.jpg'
            ]
        ];

        foreach ($citiesByCountry as $paysNom => $villes) {
            $pays = Pays::create([
                'nom' => $paysNom,
                'image_path' => 'pays/' . strtolower(str_replace(' ', '-', $paysNom)) . '.jpg'
            ]);
            
            foreach ($villes as $villeNom => $imageVille) {
                Ville::create([
                    'nom' => $villeNom,
                    'pays_id' => $pays->id,
                    'image_path' => $imageVille
                ]);
            }
        }
    }
}
