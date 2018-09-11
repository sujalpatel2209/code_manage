<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 23/8/18
 * Time: 11:46 AM
 */

namespace App\Http\Requests\Users\Profiles;


use App\Http\Requests\BaseFormRequest;

class ProfilePictureRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_pic'=>'mimes:jpg,jpeg,png|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'profile_pic.mimes' => "The Profile Picture must be jpg, jpeg, png.",
            'profile_pic.max' => "The Profile Picture size less then 2mb.",
            'profile_pic.size' => "The Profile Picture size less then 2mb."
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}