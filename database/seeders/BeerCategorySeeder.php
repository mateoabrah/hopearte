<?php

namespace Database\Seeders;

use App\Models\BeerCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BeerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si existe la tabla
        if (!Schema::hasTable('beer_categories')) {
            $this->command->error('La tabla beer_categories no existe. Ejecuta las migraciones primero.');
            return;
        }

        $categories = [
            [
                'name' => 'IPA',
                'description' => 'India Pale Ale, cerveza con alto contenido de lúpulo, amargor pronunciado y aromas cítricos o florales.',
            ],
            [
                'name' => 'Lager',
                'description' => 'Cerveza de fermentación baja, ligera, refrescante y con sabores limpios.',
            ],
            [
                'name' => 'Stout',
                'description' => 'Cerveza oscura con sabores tostados, malta y a menudo con notas de café o chocolate.',
            ],
            [
                'name' => 'Pilsner',
                'description' => 'Lager pálida originaria de República Checa, con sabor a malta ligera y un amargor distintivo del lúpulo.',
            ],
            [
                'name' => 'Wheat Beer',
                'description' => 'Cerveza elaborada con una proporción significativa de trigo, generalmente turbia con sabores afrutados.',
            ],
            [
                'name' => 'Pale Ale',
                'description' => 'Cerveza de fermentación alta con un color ámbar claro y un equilibrio entre malta y lúpulo.',
            ],
            [
                'name' => 'Porter',
                'description' => 'Cerveza oscura con un cuerpo medio, sabores a chocolate y café menos intensos que la Stout.',
            ],
            [
                'name' => 'Belgian Ale',
                'description' => 'Familia de cervezas belgas con características diversas, generalmente con sabores complejos y frutales.',
            ],
            [
                'name' => 'Sour Beer',
                'description' => 'Cervezas con acidez distintiva resultado de bacterias como Lactobacillus durante la fermentación.',
            ],
            [
                'name' => 'Amber Ale',
                'description' => 'Cerveza de color ámbar con equilibrio entre maltas caramelizadas y amargor del lúpulo.',
            ],
        ];

        foreach ($categories as $category) {
            BeerCategory::create($category);
            $this->command->info("Categoría de cerveza '{$category['name']}' creada.");
        }
    }
}
