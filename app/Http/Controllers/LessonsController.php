<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\StoreLesson;
use Illuminate\Support\Facades\Input;
use App\Transformers\LessonTransformer;


class LessonsController extends ApiController
{

    /**
     * @var LessonTransformer
     */
    private $lesson_transformer;

    /**
     * LessonsController constructor.
     *
     * @param LessonTransformer $lesson_transformer
     */
    public function __construct(LessonTransformer $lesson_transformer)
    {
        $this->lesson_transformer = $lesson_transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = Input::get('limit', 3);

        $lessons = Lesson::paginate($limit);

        return $this->respondWithPagination(
            $lessons,
            ['data' => $this->lesson_transformer->transformCollection($lessons->toArray()['data'])]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLesson|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLesson $request)
    {
        Lesson::create($request->input());

        return $this->respondCreated('Lesson was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return $this->respondNotFound('Lesson does not exist');
        }

        return $this->respond([
            'data' => $this->lesson_transformer->transform($lesson->toArray())
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
