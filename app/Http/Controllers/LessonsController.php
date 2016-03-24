<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Http\Requests\StoreLesson;
use App\Lesson;
use App\Transformers\LessonTransformer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

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
        // 1. All is bad.
        // 2. No way to attach meta data.
        // 3. Showing database schema.
        // 4. Linking the database structure to the API output
        // 5. No control over response code and headers
        $lessons = Lesson::all();

        return $this->respond([
            'data' => $this->lesson_transformer->transformCollection($lessons->toArray())
        ]);
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
