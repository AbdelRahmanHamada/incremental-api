<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformers\TagTransformer;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;

class LessonsTagsController extends ApiController
{

    /**
     * @var TagTransformer
     */
    private $tag_transformer;

    /**
     * LessonsTagsController constructor.
     *
     * @param TagTransformer $tag_transformer
     */
    public function __construct(TagTransformer $tag_transformer)
    {
        $this->tag_transformer = $tag_transformer;
    }

    /**
     * Show a lesson and tags associated to it.
     *
     * @param $lesson_id
     *
     * @return mixed
     */
    public function show($lesson_id)
    {
        try {

            $tags = Lesson::findOrFail($lesson_id)->tags->toArray();

            return $this->respond([
                'data' => $this->tag_transformer->transformCollection($tags)
            ]);
        } catch (ModelNotFoundException $ex) {
            return $this->respondNotFound('Lesson not found');
        }
    }
}
