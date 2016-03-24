<?php

namespace App\Http\Requests;

class StoreLesson extends Request
{
    /**
     * Determine if the current request is asking for JSON in return.
     *
     * @return bool
     */
    public function wantsJson()
    {
        return true;
    }

    /**
     * Check if use is authorized to access this endpoint
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
        ];
    }
}