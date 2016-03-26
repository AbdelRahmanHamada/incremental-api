<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $status_code = 200;

    /**
     * @return mixed
     */
    protected function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     *
     * @return $this
     */
    protected function setStatusCode($status_code)
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
    protected function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * Respond with pagination
     *
     * @param LengthAwarePaginator $items
     * @param array $data
     *
     * @return mixed
     */
    protected function respondWithPagination(LengthAwarePaginator $items, array $data)
    {
        $pagination = [
            'total' => $items->total(),
            'per_page' => $items->perPage(),
            'next_page_url' => $items->nextPageUrl(),
            'prev_page_url' => $items->previousPageUrl(),
            'current_page' => $items->currentPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem(),
        ];

        $data = array_merge($pagination, $data);

        return $this->respond($data);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    protected function responseWithError($message)
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
    protected function respondNotFound($message = 'Not found!')
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
    protected function respondInternalError($message = 'Internal server error!')
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
    protected function respondCreated($message)
    {
        return $this->setStatusCode(HttpResponse::HTTP_CREATED)->respond([
            'message' => $message
        ]);
    }
}