<?php

use Illuminate\Database\Seeder;

class ProductsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed box types
        DB::table('box_types')->insert([
            [
                'id'       => 1,
                'name'     => 'Carton de tonics',
                'capacity' => 6,
            ],
            [
                'id'       => 2,
                'name'     => 'Carton d\'entremets, potages et barres gourmandes',
                'capacity' => 6,
            ],
            [
                'id'       => 3,
                'name'     => 'Carton d\'idées délices',
                'capacity' => 6,
            ],
        ]);

        // Seed categories
        DB::table('categories')->insert([
            [
                'id'          => 1,
                'name'        => 'Entremet',
                'box_type_id' => 2,
            ],
            [
                'id'          => 2,
                'name'        => 'Potage',
                'box_type_id' => 2,
            ],
            [
                'id'          => 3,
                'name'        => 'Tonic',
                'box_type_id' => 1,
            ],
            [
                'id'          => 4,
                'name'        => 'Barre Gourmande',
                'box_type_id' => 2,
            ],
            [
                'id'          => 5,
                'name'        => 'Idée Délice',
                'box_type_id' => 3,
            ],
        ]);

        // Seed products
        DB::table('products')->insert([
            [
                'name'        => 'Arôme vanille crème brûlée',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Café amer',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Cappuccino',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Caprice de caramel',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Délice de fruits des îles',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Douceur de cacao',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Mix fraise franboise',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Noir de cacao',
                'description' => null,
                'category_id' => 1,
            ],
            [
                'name'        => 'Crème de champignons',
                'description' => null,
                'category_id' => 2,
            ],
            [
                'name'        => 'Jardinière de légumes',
                'description' => null,
                'category_id' => 2,
            ],
            [
                'name'        => 'Mouliné de légumes',
                'description' => null,
                'category_id' => 2,
            ],
            [
                'name'        => 'Suprême de crustacés',
                'description' => null,
                'category_id' => 2,
            ],
            [
                'name'        => 'Tomate provençale',
                'description' => null,
                'category_id' => 2,
            ],
            [
                'name'        => 'Velouté d\'aperges',
                'description' => null,
                'category_id' => 2,
            ],
            [
                'name'        => 'Arôme pomme vanille',
                'description' => null,
                'category_id' => 3,
            ],
            [
                'name'        => 'Café',
                'description' => null,
                'category_id' => 3,
            ],
            [
                'name'        => 'Fruits exotiques',
                'description' => null,
                'category_id' => 3,
            ],
            [
                'name'        => 'Mix orange grenade',
                'description' => null,
                'category_id' => 3,
            ],
            [
                'name'        => 'Pamplemousse rose',
                'description' => null,
                'category_id' => 3,
            ],
            [
                'name'        => 'Thé au citron',
                'description' => null,
                'category_id' => 3,
            ],
            [
                'name'        => 'Caramel noisette',
                'description' => null,
                'category_id' => 4,
            ],
            [
                'name'        => 'Noix de coco citron',
                'description' => null,
                'category_id' => 4,
            ],
            [
                'name'        => 'Idée délice chocolat',
                'description' => null,
                'category_id' => 5,
            ],
        ]);
    }
}
