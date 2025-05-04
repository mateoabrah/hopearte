<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brewery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BrewerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios con rol company o admin
        $companyUsers = User::where('role', 'company')
                         ->orWhere('role', 'admin')
                         ->pluck('id')
                         ->toArray();
        
        // Si no hay usuarios con estos roles, abortar
        if (empty($companyUsers)) {
            $this->command->error('No hay usuarios con rol company o admin. Las cervecerías necesitan estar asociadas a un usuario.');
            return;
        }
        
        // Lista de cervecerías ficticias
        $breweries = [
            [
                'name' => 'La Birra Dorada',
                'description' => 'Cervecería artesanal fundada por apasionados de la cerveza. Nos especializamos en cervezas de estilo belga y alemán, elaboradas con ingredientes naturales de la más alta calidad.',
                'city' => 'Barcelona',
                'address' => 'Carrer del Torrent de l\'Olla, 175',
                'latitude' => 41.404887,
                'longitude' => 2.153889,
                'founded_year' => 2015,
                'website' => 'https://labirradorada.com',
                'visitable' => true,
            ],
            [
                'name' => 'Cerveza Montaña',
                'description' => 'Pequeña cervecería ubicada en las afueras de la ciudad. Nuestras cervezas se inspiran en los sabores de la montaña, utilizando agua de manantial y hierbas locales.',
                'city' => 'Madrid',
                'address' => 'Calle de Fuencarral, 45',
                'latitude' => 40.426147,
                'longitude' => -3.702240,
                'founded_year' => 2018,
                'website' => 'https://cervezamontana.es',
                'visitable' => true,
            ],
            [
                'name' => 'Lupulus Craft',
                'description' => 'Somos pioneros en la elaboración de cervezas IPA en España. Nuestro maestro cervecero ha ganado varios premios internacionales por sus creaciones innovadoras.',
                'city' => 'Valencia',
                'address' => 'Avinguda del Port, 87',
                'latitude' => 39.464691,
                'longitude' => -0.326308,
                'founded_year' => 2012,
                'website' => 'https://lupuluscraft.com',
                'visitable' => false,
            ],
            [
                'name' => 'Cervecería del Norte',
                'description' => 'Tradición cervecera desde 1956. Elaboramos nuestras cervezas siguiendo recetas familiares transmitidas de generación en generación, con un toque moderno.',
                'city' => 'Bilbao',
                'address' => 'Calle Licenciado Poza, 16',
                'latitude' => 43.262985,
                'longitude' => -2.935013,
                'founded_year' => 1956,
                'website' => 'https://cerveceriadelnorte.com',
                'visitable' => true,
            ],
            [
                'name' => 'Malasuerte Brewing Co.',
                'description' => 'Cervecería urbana con espíritu rebelde. Nuestras cervezas experimentales desafían los estilos tradicionales y exploran nuevos horizontes de sabor.',
                'city' => 'Sevilla',
                'address' => 'Calle Feria, 35',
                'latitude' => 37.398333,
                'longitude' => -5.994167,
                'founded_year' => 2019,
                'website' => 'https://malasuertebrewing.com',
                'visitable' => true,
            ],
            [
                'name' => 'La Abadía',
                'description' => 'Inspirados en las cervezas trapenses, elaboramos nuestros productos con técnicas tradicionales en un antiguo monasterio restaurado como fábrica.',
                'city' => 'Granada',
                'address' => 'Calle Elvira, 23',
                'latitude' => 37.178055,
                'longitude' => -3.598889,
                'founded_year' => 2008,
                'website' => 'https://laabadiacerveza.es',
                'visitable' => true,
            ],
            [
                'name' => 'Isla Brewing Project',
                'description' => 'Nacimos como un proyecto de amigos que se convirtió en una reconocida cervecería. Nos especializamos en cervezas frescas y tropicales.',
                'city' => 'Palma de Mallorca',
                'address' => 'Carrer Sant Magí, 41',
                'latitude' => 39.569600,
                'longitude' => 2.638333,
                'founded_year' => 2016,
                'website' => 'https://islabrewing.com',
                'visitable' => false,
            ],
            [
                'name' => 'Cerveza Volcánica',
                'description' => 'Elaboramos nuestras cervezas en terreno volcánico, aprovechando las propiedades minerales del agua filtrada a través de la roca volcánica.',
                'city' => 'Tenerife',
                'address' => 'Calle San José, 15, La Orotava',
                'latitude' => 28.389410,
                'longitude' => -16.523600,
                'founded_year' => 2014,
                'website' => 'https://cervezavolcanica.com',
                'visitable' => true,
            ],
            [
                'name' => 'Lúpulo Errante',
                'description' => 'Cervecería nómada que colabora con diferentes productores para crear ediciones limitadas y experimentales que cambian con cada temporada.',
                'city' => 'Zaragoza',
                'address' => 'Calle Don Jaime I, 38',
                'latitude' => 41.651111,
                'longitude' => -0.878611,
                'founded_year' => 2017,
                'website' => 'https://lupuloerrante.es',
                'visitable' => false,
            ],
            [
                'name' => 'Cervezas Atlánticas',
                'description' => 'El sabor del Atlántico en cada sorbo. Nuestras cervezas reflejan el carácter salvaje del océano y la brisa marina.',
                'city' => 'A Coruña',
                'address' => 'Rúa de San Andrés, 156',
                'latitude' => 43.368889,
                'longitude' => -8.398333,
                'founded_year' => 2011,
                'website' => 'https://cervezasatlanticas.gal',
                'visitable' => true,
            ]
        ];

        // Inserta las cervecerías
        foreach ($breweries as $breweryData) {
            // Asigna un usuario aleatorio de los disponibles
            $breweryData['user_id'] = $companyUsers[array_rand($companyUsers)];
            
            Brewery::create($breweryData);
            
            $this->command->info("Cervecería '{$breweryData['name']}' creada.");
        }
    }
}
