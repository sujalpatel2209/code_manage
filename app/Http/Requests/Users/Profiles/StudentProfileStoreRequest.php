<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 21/8/18
 * Time: 12:31 PM
 */

namespace App\Http\Requests\Users\Profiles;


use App\Http\Requests\BaseFormRequest;
use Carbon\Carbon;

class StudentProfileStoreRequest extends BaseFormRequest
{

    public function rules()
    {
        $dob= Carbon::parse($this->dob)->format('Y');
        return [
            'email'=>'required|email|max:50|min:3',
            'mobilenumber'=>'required|min:12',
            'contact_by'=>'required',
            'skype_id'=>'nullable|required_if:contact_by,==,3',
            'other'=>'nullable|required_if:contact_by,==,4',
            'address_1'=>'required|max:50|min:3|regex:/^[0-9A-Za-z \s-,\/]*+$/',
            'address_2'=>'nullable|regex:/^[0-9A-Za-z \s-,\/]*+$/',
            'activities' =>'nullable|regex:/^[A-Za-z\s,]+$/',
            'city'=>'required|max:20|min:3|regex:/^[A-Za-z\s]+$/',
            'timezone'=>'required',
            'pincode'=>'required|max:7|min:5',

                    'personality'=>'nullable|min:3|max:50|regex:/^[A-Za-z,\s]+$/',
                    'dob'=>'nullable|date',
                    'school_name'=>'nullable|max:50',
                    'school_year'=>'nullable|numeric|gte:graduation_year|gt:'.$dob,
                    'school_city'=>'nullable|min:3|max:20',
                    'graduation_year'=>'nullable|numeric|gt:'.$dob,

            'test_score_type'=>'array',
            'test_scores'=>'array',
            'test_score_date'=>'array',
            'test_score_type.*' => 'nullable|required_with:test_scores.*,test_score_date.*',
            'test_scores.*' =>'nullable|required_with:test_score_type.*,test_score_date.*',
            'test_score_date.*' => 'nullable|required_with:test_scores.*,test_score_type.*|date|after:dob',

            'unweighted_gpa'=>'required|numeric|max:100|min:1|gte:weighted_gpa',
            'weighted_gpa'=>'required|numeric|max:100|min:1',
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
            "activities.regex" => "The activities allows only  characters or space.",
            'city.regex' => 'The city allows only characters or space.',
            "skype_id.regex" => "The skype allows only characters or numeric or email.",
            'other.regex' => 'The other allows only characters.',
            "timezone.required" => "The state-timezone must be selected.",
            "pincode.required" => "The zip code must be required.",
            "pincode.max" => "The zipcode may not be greater than 7 characters.",
            "pincode.min" => "The zipcode must be at least 5 characters.",
            "dob.required" => "The date of birth must be required.",
            "dob.date" => "The date of birth enter valid date.",
            "test_score_type.*.required_with" => 'The test scores all filed must be required or empty.',
            "test_scores.*.required_with"=> 'The test scores all filed must be required or empty.',
            "test_score_date.*.required_with" => 'The test scores all filed must be required or empty.',
            "test_score_date.*.date" => 'The test scores date enter valid date.',
            "test_score_date.*.after" => 'The test scores date enter after date of birth.',
            "unweighted_gpa.gte" => "The unweighted gpa must be greater than or equal to weighted gpa field.",
            'other.required_if' => "The other fields must be requires when select contact method as other",
            'skype_id.required_if' => "Skype field is required when you select Skype as mode of contact.",
            'personality.regex' => 'The  personality must be characters or comma.',
            'school_year.gte.graduation_year' => "The current school year must be greater than or equal high school graduation year.",
            'school_year.gt' => "The current school year must be greater than  birth date year .",
            'graduation_year.gt' => "The graduation year must be greater than  birth date year .",
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