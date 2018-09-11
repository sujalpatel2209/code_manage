<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 14/8/18
 * Time: 3:01 PM
 */

namespace App\Http\Requests\Users\Auth;
use App\Http\Requests\BaseFormRequest;

class RegisterCreateRequest extends BaseFormRequest
{

    public function authorize()
    {
     return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:15|regex:/^[A-Za-z]+$/',
            'last_name' => 'required|max:15|regex:/^[A-Za-z]+$/',
            'email' => 'required|email|unique:users,email',
            'contact_no' => 'required|unique:users,mobile|min:12',
            'password' => 'required|regex:/^(?=.*?[a-zA-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'confirm_password' => 'required|same:password',
            'relationShip'=> 'array',
            'relationShip.0'=> 'required|regex:/^[A-Za-z\s]+$/',
            'relationShip.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1',
            'firstname' => 'array',
            'firstname.0' => 'required|regex:/^[A-Za-z]+$/',
            'firstname.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1',
            'lastname' => 'array',
            'lastname.0' => 'required|regex:/^[A-Za-z]+$/',
            'lastname.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1',
            'mobileNo' => 'array',
            'mobileNo.0' => 'required|min:12',
            'mobileNo.1' => 'nullable|required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1|min:12',
            'emailId' => 'array',
            'emailId.0' => 'required|email|different:email',
            'emailId.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1|different:email',
        ];
    }

    public function messages()
    {
        return [
            'first_name'=>'First Name must be required.',
            'last_name.regex'=> 'The last name allows only characters',
            'first_name.regex'=> 'The first name allows only characters',
            'relationShip.0.required' => 'Parent relation must be required.',
            'relationShip.0.regex' => 'The Parent relation allows only characters or space.',
            'firstname.0.required' => 'Parent first name must be required.',
            'firstname.1.regex' => 'parent first name allows only characters',
            'firstname.0.regex' => 'The Parent first name  allows only characters.',
            'lastname.0.required' => 'Parent last name must be required.',
            'lastname.0.regex' => 'The Parent last name  allows only characters.',
            'mobileNo.0.required' => 'Parent mobile must be required.',
            'mobileNo.0.min' => 'Parent mobile must be 10 characters required.',
            'emailId.0.required' => 'Parent email must be required.',
            'password.regex' => 'Password at least 8 characters, 1 special character and 1 number',
            'relationShip.1.required_with'=>'parent2 all filed must be required or empty.',
            'relationShip.1.regex' => 'The Parent2 relation allows only characters or space.',
            'firstname.1.required_with'=>'parent2 all filed must be required or empty.',
            'firstname.1.required' => 'Parent first name must be required.',
            'lastname.1.required_with'=>'parent2 all filed must be required or empty.',
            'lastname.1.regex' => 'The Parent last name  allows only characters',
            'mobileNo.1.required_with'=>'parent2 all filed must be required or empty.',
            'mobileNo.1.min' => 'Parent mobile must be 10 characters required.',
            'emailId.1.required_with'=>'parent2 all filed must be required or empty.',
            'emailId.0.different' => "The student email or parent email cant same.",
            'emailId.1.different' => "The student email or parent email cant same.",
            'contact_no.min'=>'The mobile number must be 10 characters.'
        ];
    }
    public function filters()
    {
        return [
            'first_name' => 'trim|capitalize|escape',
            'last_name' => 'trim|capitalize|escape',

            'firstname' => 'trim|capitalize|escape',
            'firstname.1' => 'trim|capitalize|escape',
            'firstname.2' => 'trim|capitalize|escape',

            'lastname' => 'trim|capitalize|escape',
            'lastname.1' => 'trim|capitalize|escape',
            'lastname.2' => 'trim|capitalize|escape',

            'email'=> 'trim|lowercase|escape',
            'emailId'=> 'trim|lowercase|escape',
            'emailId.1'=> 'trim|lowercase|escape',
            'emailId.2'=> 'trim|lowercase|escape',

            'password'=> 'trim|escape',
            'relationShip.0'=> 'trim|escape',
            'relationShip.1'=> 'trim|escape',
            'relationShip.2'=> 'trim|escape',

        ];
    }

}