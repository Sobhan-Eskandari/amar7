<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CoureseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses_categories')->truncate();

        $faker = Faker::create("fa_IR");
        $categories = [];

        foreach (range(1, 1000) as $index){
            $categories[] = [
                'name' => $faker->name,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ];
        }

        DB::table('courses_categories')->insert($categories);
    }
}
