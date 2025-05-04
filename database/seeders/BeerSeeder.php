<?php

namespace Database\Seeders;

use App\Models\Beer;
use App\Models\BeerCategory;
use App\Models\Brewery;
use Illuminate\Database\Seeder;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar que hay cervecerías y categorías
        $breweries = Brewery::all();
        $categories = BeerCategory::all();

        if ($breweries->isEmpty()) {
            $this->command->error('No hay cervecerías disponibles. Ejecuta primero el BrewerySeeder.');
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->error('No hay categorías de cerveza disponibles. Ejecuta primero el BeerCategorySeeder.');
            return;
        }

        // Lista de cervezas ficticias
        $beers = [
            // La Birra Dorada (Barcelona)
            [
                'brewery_name' => 'La Birra Dorada',
                'beers' => [
                    [
                        'name' => 'Dorada Clásica',
                        'category' => 'Lager',
                        'description' => 'Nuestra cerveza insignia, elaborada con cebada local y lúpulo aromático europeo. Sabor equilibrado y refrescante.',
                        'abv' => 4.8,
                        'ibu' => 22,
                        'color' => 'Dorado',
                        'first_brewed' => 2015,
                        'seasonal' => false,
                    ],
                    [
                        'name' => 'Trigo Mediterráneo',
                        'category' => 'Wheat Beer',
                        'description' => 'Cerveza de trigo con toques cítricos y un final ligeramente especiado. Perfecta para los días de calor.',
                        'abv' => 5.2,
                        'ibu' => 15,
                        'color' => 'Amarillo pálido',
                        'first_brewed' => 2016,
                        'seasonal' => false,
                    ],
                    [
                        'name' => 'IPA Catalana',
                        'category' => 'IPA',
                        'description' => 'IPA con un toque mediterráneo, utilizando lúpulos locales y americanos. Aromas cítricos y tropicales.',
                        'abv' => 6.5,
                        'ibu' => 65,
                        'color' => 'Ámbar',
                        'first_brewed' => 2017,
                        'seasonal' => false,
                    ]
                ]
            ],
            // Cerveza Montaña (Madrid)
            [
                'brewery_name' => 'Cerveza Montaña',
                'beers' => [
                    [
                        'name' => 'Pico Nevado',
                        'category' => 'Pilsner',
                        'description' => 'Pilsner cristalina inspirada en el agua pura de montaña. Sabor limpio con un ligero amargor.',
                        'abv' => 4.5,
                        'ibu' => 35,
                        'color' => 'Dorado claro',
                        'first_brewed' => 2018,
                        'seasonal' => false,
                    ],
                    [
                        'name' => 'Bosque Oscuro',
                        'category' => 'Porter',
                        'description' => 'Porter robusta con sabores a chocolate negro y café tostado. Un abrazo cálido para días fríos.',
                        'abv' => 5.8,
                        'ibu' => 28,
                        'color' => 'Marrón oscuro',
                        'first_brewed' => 2019,
                        'seasonal' => false,
                    ]
                ]
            ],
            // Lupulus Craft (Valencia)
            [
                'brewery_name' => 'Lupulus Craft',
                'beers' => [
                    [
                        'name' => 'Triple Lúpulo',
                        'category' => 'IPA',
                        'description' => 'IPA potente con triple adición de lúpulo. Explosión de aromas cítricos y resinosos.',
                        'abv' => 7.2,
                        'ibu' => 75,
                        'color' => 'Ámbar profundo',
                        'first_brewed' => 2013,
                        'seasonal' => false,
                    ],
                    [
                        'name' => 'Session Naranja',
                        'category' => 'Pale Ale',
                        'description' => 'Session IPA con piel de naranja valenciana. Baja graduación pero gran sabor cítrico.',
                        'abv' => 4.0,
                        'ibu' => 40,
                        'color' => 'Dorado',
                        'first_brewed' => 2015,
                        'seasonal' => false,
                    ],
                    [
                        'name' => 'Imperial Tropical',
                        'category' => 'IPA',
                        'description' => 'Double IPA con lúpulos tropicales. Potente, jugosa y aromática.',
                        'abv' => 8.5,
                        'ibu' => 85,
                        'color' => 'Ámbar rojizo',
                        'first_brewed' => 2016,
                        'seasonal' => true,
                    ]
                ]
            ],
            // Cervecería del Norte (Bilbao)
            [
                'brewery_name' => 'Cervecería del Norte',
                'beers' => [
                    [
                        'name' => 'Tradición 1956',
                        'category' => 'Amber Ale',
                        'description' => 'Receta original de nuestra fundación. Cerveza ámbar con equilibrio perfecto entre dulzor y amargor.',
                        'abv' => 5.5,
                        'ibu' => 30,
                        'color' => 'Ámbar',
                        'first_brewed' => 1956,
                        'seasonal' => false,
                    ],
                    [
                        'name' => 'Sidra del Cantábrico',
                        'category' => 'Sour Beer',
                        'description' => 'Cerveza ácida inspirada en la tradición sidrera vasca. Refrescante y con notas de manzana verde.',
                        'abv' => 5.0,
                        'ibu' => 10,
                        'color' => 'Amarillo pálido',
                        'first_brewed' => 2010,
                        'seasonal' => false,
                    ]
                ]
            ],
            // Resto de cervecerías con al menos una cerveza cada una...
            [
                'brewery_name' => 'Malasuerte Brewing Co.',
                'beers' => [
                    [
                        'name' => 'Rebelde Sin Causa',
                        'category' => 'IPA',
                        'description' => 'IPA experimental con lúpulos poco convencionales. Cada lote es una sorpresa diferente.',
                        'abv' => 6.6,
                        'ibu' => 66,
                        'color' => 'Variable',
                        'first_brewed' => 2020,
                        'seasonal' => false,
                    ]
                ]
            ],
            [
                'brewery_name' => 'La Abadía',
                'beers' => [
                    [
                        'name' => 'Trappist Española',
                        'category' => 'Belgian Ale',
                        'description' => 'Inspirada en las cervezas trapenses belgas. Rica, compleja y con notas de frutas pasas.',
                        'abv' => 7.5,
                        'ibu' => 25,
                        'color' => 'Ámbar oscuro',
                        'first_brewed' => 2009,
                        'seasonal' => false,
                    ]
                ]
            ],
            [
                'brewery_name' => 'Isla Brewing Project',
                'beers' => [
                    [
                        'name' => 'Brisa Marina',
                        'category' => 'Pale Ale',
                        'description' => 'Pale ale ligera con un toque salino que recuerda al mar Mediterráneo.',
                        'abv' => 5.0,
                        'ibu' => 35,
                        'color' => 'Dorado pálido',
                        'first_brewed' => 2017,
                        'seasonal' => false,
                    ]
                ]
            ],
            [
                'brewery_name' => 'Cerveza Volcánica',
                'beers' => [
                    [
                        'name' => 'Lava Negra',
                        'category' => 'Stout',
                        'description' => 'Stout imperial intensa como la lava volcánica. Sabores a chocolate, café y un toque mineral único.',
                        'abv' => 9.0,
                        'ibu' => 50,
                        'color' => 'Negro intenso',
                        'first_brewed' => 2015,
                        'seasonal' => false,
                    ]
                ]
            ],
            [
                'brewery_name' => 'Lúpulo Errante',
                'beers' => [
                    [
                        'name' => 'Nómada',
                        'category' => 'IPA',
                        'description' => 'IPA experimental que cambia con cada lote. Esta edición presenta notas de frutas tropicales y pino.',
                        'abv' => 6.8,
                        'ibu' => 60,
                        'color' => 'Ámbar',
                        'first_brewed' => 2018,
                        'seasonal' => true,
                    ]
                ]
            ],
            [
                'brewery_name' => 'Cervezas Atlánticas',
                'beers' => [
                    [
                        'name' => 'Marejada',
                        'category' => 'Pale Ale',
                        'description' => 'Pale ale atlántica con un toque salino y aroma a lúpulos frescos.',
                        'abv' => 5.5,
                        'ibu' => 40,
                        'color' => 'Ámbar claro',
                        'first_brewed' => 2012,
                        'seasonal' => false,
                    ]
                ]
            ],
        ];

        // Procesar y crear las cervezas
        foreach ($beers as $breweryBeers) {
            // Encontrar la cervecería correspondiente
            $brewery = $breweries->where('name', $breweryBeers['brewery_name'])->first();
            
            if (!$brewery) {
                $this->command->warn("No se encontró la cervecería '{$breweryBeers['brewery_name']}'. Saltando sus cervezas.");
                continue;
            }
            
            foreach ($breweryBeers['beers'] as $beerData) {
                // Encontrar la categoría correspondiente
                $category = $categories->where('name', $beerData['category'])->first();
                
                if (!$category) {
                    $this->command->warn("No se encontró la categoría '{$beerData['category']}' para la cerveza '{$beerData['name']}'. Asignando NULL.");
                }
                
                // Preparar los datos para crear la cerveza
                $beerToCreate = [
                    'brewery_id' => $brewery->id,
                    'beer_category_id' => $category ? $category->id : null,
                    'name' => $beerData['name'],
                    'description' => $beerData['description'],
                    'abv' => $beerData['abv'],
                    'ibu' => $beerData['ibu'],
                    'color' => $beerData['color'],
                    'first_brewed' => $beerData['first_brewed'],
                    'seasonal' => $beerData['seasonal'],
                ];
                
                // Crear la cerveza
                Beer::create($beerToCreate);
                $this->command->info("Cerveza '{$beerData['name']}' creada para '{$brewery->name}'.");
            }
        }
    }
}
