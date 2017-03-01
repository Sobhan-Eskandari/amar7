<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WikiCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_categories')->truncate();

        $faker = Faker::create("fa_IR");
        $categories = [];

        foreach (range(1, 1000) as $index){
            $categories[] = [
                'name' => $faker->name,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ];
        }

        DB::table('wiki_categories')->insert($categories);

    }
}
