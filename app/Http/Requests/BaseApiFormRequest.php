<?php

/**
 * Created by PhpStorm.
 * User: KameR <kashyapk62@gmail.com>
 * Date: 12-05-2018
 * Time: 06:02 PM
 */


namespace App\Http\Requests;

use App\AppConstant\ApiConstant;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Waavi\Sanitizer\Laravel\SanitizesInput;

abstract class BaseApiFormRequest extends FormRequest
{
    use ApiResponse, SanitizesInput;

    /**
     * For more sanitizer rule check https://github.com/Waavi/Sanitizer
     */
    public function validateResolved()
    {
        {
            $this->sanitize();
            parent::validateResolved();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $this->setMeta("status", ApiConstant::STATUS_FAIL);
        $this->setMeta("message", $validator->messages()->first());
        throw new HttpResponseException(response()->json($this->setResponse(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}
