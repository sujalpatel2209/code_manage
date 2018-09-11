<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 21/8/18
 * Time: 12:30 PM
 */

namespace App\Http\Requests\Users\Profiles;


use App\Http\Requests\BaseFormRequest;

class ParentProfileStoreRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
//            'first_name'=>'required|max:15|min:3',
            'email'=>'required|email|max:50|min:3',
            'mobilenumber'=>'required|min:12',
            'contact_by'=>'required',
            'address_1'=>'required|max:50|min:3|regex:/^[0-9A-Za-z \s-,\/]*+$/',
            'address_2'=>'nullable|max:50|min:3|regex:/^[0-9A-Za-z \s-,\/]*+$/',
            'city'=>'required|max:20|min:3|regex:/^[A-Za-z\s]+$/',
            'timezone'=>'required',
            'pincode'=>'required|max:6|min:5',

            'activities' =>'nullable|regex:/^[A-Za-z\s,]+$/',

            'other'=>'required_if:contact_by,==,4',
            'skype_id'=>'required_if:contact_by,==,3',
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
    public function messages()
    {
        return [
            'mobilenumber.required'=>"The mobile number field is required.",
            'mobilenumber.min'=>"The mobile number must be 10 character.",
            "contact_by.required"=>"The contact method must be selected.",
            "address_1.regex" => "The address 1 allows only characters, space, numeric, slash, comma.",
            "address_2.regex" => "The address 2 allows only characters, space, numeric, slash, comma.",
            "timezone.required" => "The state-timezone must be selected.",
            "pincode.required" => "The zip code must be required.",
            "pincode.max" => "The zipcode may not be greater than 7 characters.",
            "pincode.min" => "The zipcode must be at least 5 characters.",
            "city.regex" => "The city allows only characters or space.",
            "activities.regex" => "The activities allows only  characters or space.",
            'other.required_if' => "The other fields must be requires when select contact method as other",
            'skype_id.required_if' => "Skype field is required when you select Skype as mode of contact.",
            "skype_id.regex" => "The skype allows only characters or numeric or email.",
        ];
    }
    public function filters()
    {
        return [
            'address_1' => 'trim|escape',
            'address_2' => 'trim|escape',
            'activities' => 'trim|escape',
            'city' => 'trim|capitalize|escape',
            'skype_id' => 'trim|escape',
            'other' => 'trim|capitalize|escape',
        ];
    }

}