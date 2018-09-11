<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 20/8/18
 * Time: 5:41 PM
 */

namespace App\Http\Requests\Users\Auth;


use App\Http\Requests\BaseFormRequest;

class ParentRegisterCreateRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
            'contact_no' => 'required|unique:users,mobile|min:12',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^(?=.*?[a-zA-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'confirm_password' => 'required|same:password',
            'relationShip'=> 'array',
            'relationShip.0'=> 'required',
            'relationShip.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1',
            'relationShip.2' => 'required_with:relationShip.2,lastname.2,mobileNo.2,emailId.2',
            'firstname' => 'array',
            'firstname.0' => 'required',
            'firstname.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1',
            'firstname.2' => 'required_with:relationShip.2,lastname.2,mobileNo.2,emailId.2',
            'lastname' => 'array',
            'lastname.0' => 'required',
            'lastname.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1',
            'lastname.2' => 'required_with:relationShip.3,lastname.2,mobileNo.2,emailId.2',
            'mobileNo' => 'array',
            'mobileNo.0' => 'required|min:12',
            'mobileNo.1' => 'nullable|required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1|min:12',
            'mobileNo.2' => 'nullable|required_with:relationShip.2,lastname.2,mobileNo.2,emailId.2|min:12',
            'emailId' => 'array',
            'emailId.0' => 'required|different:email',
            'emailId.1' => 'required_with:relationShip.1,lastname.1,mobileNo.1,emailId.1|different:email',
            'emailId.2' => 'required_with:relationShip.2,lastname.2,mobileNo.2,emailId.2|different:email',
        ];
    }

    public function messages()
    {
        return [
            'first_name'=>'First Name must be required.',
            'relationShip.0.required' => 'Student relation must be required.',
            'firstname.0.required' => 'Student first name must be required.',
            'lastname.0.required' => 'Student last name must be required.',
            'contact_no.required' => 'The mobile must be required.',
            'contact_no.unique' => 'The mobile number has already been taken.',
            'mobileNo.0.required' => 'The Student mobile must be required.',
            'mobileNo.0.min' => 'The Student mobile must be 10 characters required.',
            'mobileNo.1.min' => 'The Student mobile must be 10 characters required.',
            'mobileNo.2.min' => 'The Student mobile must be 10 characters required.',
            'emailId.0.required' => 'Student email must be required.',
            'password.regex' => 'Password at least 8 characters, 1 special character and 1 number',
            'relationShip.1.required_with'=>'Student2 all filed must be required or empty.',
            'firstname.1.required_with'=>'Student2 all filed must be required or empty.',
            'lastname.1.required_with'=>'Student2 all filed must be required or empty.',
            'mobileNo.1.required_with'=>'Student2 all filed must be required or empty.',
            'emailId.1.required_with'=>'Student2 all filed must be required or empty.',
            'relationShip.2.required_with'=>'Student3 all filed must be required or empty.',
            'firstname.2.required_with'=>'Student3 all filed must be required or empty.',
            'lastname.2.required_with'=>'Student3 all filed must be required or empty.',
            'mobileNo.2.required_with'=>'Student3 all filed must be required or empty.',
            'emailId.2.required_with'=>'Student3 all filed must be required or empty.',
            'emailId.0.different' => "The student email or parent email cant same.",
            'emailId.1.different' => "The student email or parent email cant same.",
            'emailId.2.different' => "The student email or parent email cant same.",
            'contact_no.min'=>'The mobile number must be 10 characters.'
        ];
    }
    public function filters()
    {
        return [
            'first_name' => 'trim|capitalize|escape',
            'last_name' => 'trim|capitalize|escape',

            'firstname.0' => 'trim|capitalize|escape',
            'firstname.1' => 'trim|capitalize|escape',

            'lastname.1' => 'trim|capitalize|escape',
            'lastname.1' => 'trim|capitalize|escape',

            'lastname.2' => 'trim|capitalize|escape',
            'lastname.2' => 'trim|capitalize|escape',

            'email'=> 'trim|lowercase|escape',
            'emailId.0'=> 'trim|lowercase|escape',
            'emailId.1'=> 'trim|lowercase|escape',
            'password'=> 'trim|escape',
            'relationShip.0'=> 'trim|escape',
            'relationShip.1'=> 'trim|escape',
            'relationShip.2'=> 'trim|escape',

        ];
    }
}