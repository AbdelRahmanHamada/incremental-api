<?php

use App\Lesson;
use App\Tag;
use Illuminate\Database\Seeder;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Lesson::class, 50)->create()->each(function ($lesson) {
            $lesson->tags()->save(factory(Tag::class)->make());
        });
    }
}
