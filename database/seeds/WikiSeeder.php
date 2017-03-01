<?php

use App\Wiki;
use App\WikiCategories;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WikiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wikis')->truncate();
        DB::table('wiki_wiki_categories')->truncate();

        $faker = Faker::create("fa_IR");
        $wiki_categories = WikiCategories::pluck('id');
        $last = count($wiki_categories) - 1;

        foreach (range(1, 200) as $index){
            $wiki = Wiki::create([
                'title' => $faker->name,
                'body' => $faker->realText(500),
                'user_id' => '1'
            ]);

            if (count($wiki_categories))
            {
                $wiki->wiki_categories()->attach( $wiki_categories[ rand(0, $last ) ] );
            }

        }
    }
}
