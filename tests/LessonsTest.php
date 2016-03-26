<?php

use App\Lesson;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LessonsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Persists a lesson inside the database
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function makeLesson(array $attributes = [])
    {
        return factory(Lesson::class)->create($attributes);
    }

    /** @test */
    public function it_fetches_lessons()
    {
        $this->makeLesson();

        $this->get('/api/v1/lessons');

        $this->seeJson()->assertResponseOk();
    }

    /** @test */
    public function it_404s_if_lesson_not_found()
    {
        $this->get('/api/v1/lessons/334345345');

        $this->seeJson()->assertResponseStatus(Response::HTTP_NOT_FOUND);
    }
}
