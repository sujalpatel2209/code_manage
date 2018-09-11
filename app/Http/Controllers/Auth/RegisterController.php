<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Services\StudentServices;

use App\Http\Requests\Users\Auth\ParentRegisterCreateRequest;
use App\Http\Requests\Users\Auth\RegisterCreateRequest;
use App\Http\Requests\Users\Profiles\ProfilePictureRequest;
use App\Http\Requests\Users\Profiles\StudentProfileStoreRequest;
use App\Http\Requests\Users\Profiles\ParentProfileStoreRequest;
use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $studentServices, $data;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StudentServices $studentServices)
    {
        $this->middleware('auth.admin');
        $this->studentServices = $studentServices;
        $this->data = [];
    }

    public function index()
    {
        return view('authentication.index');
    }

    public function register(RegisterCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->data = $this->studentServices->studentRegister($request);
            DB::commit();
            return redirect()->route('student.profile', [$this->data['users']->id]);
        } catch (QueryException $e) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
            return redirect()->back();
        }

    }

    public function parentsregister(ParentRegisterCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->data = $this->studentServices->parentsRegister($request);
            DB::commit();
            return redirect()->route('student.profile', [$this->data['users']->id]);
        } catch (QueryException $e) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
            return redirect()->back();
        }

    }

    public function studentProfile($id)
    {
        $this->data = $this->studentServices->getProfile($id);
        return view('authentication.step2')->with('data', $this->data);
    }

    public function studentProfileStore(StudentProfileStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->data = $this->studentServices->studentProfileStore($request);
            DB::commit();
            return redirect()->route('login');
//        return view('authentication.step2')->with('data',$this->data);
        } catch (QueryException $e) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
            return redirect()->back();
        }
    }

    public function parentProfileStore(ParentProfileStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->data = $this->studentServices->parentProfileStore($request);
            DB::commit();
            return redirect()->route('login');
        } catch (QueryException $e) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
            return redirect()->back();
        }
    }
    public function studentProfilePicture(ProfilePictureRequest $request)
    {
        return $this->studentServices->updateProfile($request);
    }

}
