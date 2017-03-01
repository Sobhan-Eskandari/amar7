<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CoureseCategorySeeder');
        $this->call('WikiCategoriesSeeder');
        $this->call('WikiSeeder');
        $this->call('LessonsSeeder');
    }
}
