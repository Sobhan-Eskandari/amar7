<?php

use App\CoursesCategories;
use App\Lesson;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->truncate();
        DB::table('courses_categories_lesson')->truncate();

        $faker = Faker::create("fa_IR");
        $lesson_categories = CoursesCategories::pluck('id');
        $last = count($lesson_categories) - 1;

        foreach (range(1, 200) as $index){
            $lesson = Lesson::create([
                'user_id'=>'1',
                'lesson_name' => $faker->name,
                'lesson_desc' => $faker->realText(200),
                'instructor' => $faker->name,
                'instructor_desc' => $faker->realText(200),
                'cost' => '30000',
                'media' => 'video,pdf',
            ]);

            if (count($lesson_categories))
            {
                $lesson->categories()->attach( $lesson_categories[ rand(0, $last ) ] );
            }

        }
    }
}
