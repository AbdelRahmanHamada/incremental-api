<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests;
use App\Transformers\TagTransformer;


class TagsController extends ApiController
{
    protected $tag_transformer;

    /**
     * TagsController constructor.
     *
     * @param $tag_transformer
     */
    public function __construct(TagTransformer $tag_transformer)
    {
        $this->tag_transformer = $tag_transformer;
    }

    /**
     * Show a list of tags
     */
    public function index()
    {
        return $this->respond([
            'data' => $this->tag_transformer->transformCollection(Tag::all()->toArray())
        ]);
    }
}
