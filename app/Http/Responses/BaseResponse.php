<?php
/**
 * Created by PhpStorm.
 * User: KameR <kashayapk62@gmail.com>
 * Date: 13-05-2018
 * Time: 08:56 PM
 */

namespace App\Http\Responses;


use App\AppConstant\ApiConstant;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class BaseResponse implements Responsable
{

    use ApiResponse;
    protected $data, $message;


    /**
     * BaseResponse constructor.
     * @param array $data
     * @param string $message
     */
    function __construct(string $message, array $data = [])
    {
        $this->data = $data;
        $this->message = $message;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {

        return response()->json($this->responseBuilder(), JsonResponse::HTTP_OK);
    }

    /**
     * @return mixed
     */
    public function responseBuilder()
    {
        $this->setMeta("status", ApiConstant::STATUS_OK);
        $this->setMeta("message", $this->message);
        foreach ($this->data as $key => $value) {
            $this->setData($key, $value);
        }
        return $this->setResponse();

    }
}