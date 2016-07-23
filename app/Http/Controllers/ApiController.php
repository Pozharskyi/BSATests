<?php


namespace App\Http\Controllers;


use Response;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * @var
     */
    protected $statusCode;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }
    public function respondUnprocessableEntity($message = 'Unprocessable Entity')
    {
        return $this->setStatusCode(422)->respondWithError($message);
    }

    public function respondCreated()
    {
        return $this->setStatusCode(201)->respond([
            'message' => 'Book has been created successfully'
        ]);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }


}