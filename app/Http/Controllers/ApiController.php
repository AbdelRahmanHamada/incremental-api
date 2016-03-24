<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $status_code = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     *
     * @return $this
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }

    /**
     * @param $data
     * @param array $header
     *
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    public function responseWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Response with a 404 error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondNotFound($message = 'Not found!')
    {
        return $this->setStatusCode(HttpResponse::HTTP_NOT_FOUND)->responseWithError($message);

    }

    /**
     * Respond with a 500 error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondInternalError($message = 'Internal server error!')
    {
        return $this->setStatusCode(HttpResponse::HTTP_INTERNAL_SERVER_ERROR)->responseWithError($message);
    }

    /**
     * Respond with a created message.
     *
     * @param $message
     *
     * @return mixed
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(HttpResponse::HTTP_CREATED)->respond([
            'message' => $message
        ]);
    }
}