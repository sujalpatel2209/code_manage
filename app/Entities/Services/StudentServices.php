<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 14/8/18
 * Time: 4:58 PM
 */

namespace App\Entities\Services;


use App\AppConstant\AppConstant;
use App\Entities\Models\Activities;
use App\Entities\Models\ContactMethod;
use App\Entities\Models\ParentsInvite;
use App\Entities\Models\States;
use App\Entities\Models\StudentInvite;
use App\Entities\Models\StudentParentRelation;
use App\Entities\Models\Students;
use App\Entities\Models\StudentSchoolName;
use App\Entities\Models\StudentsProfile;
use App\Entities\Models\TestScore;
use App\Entities\Models\TestSubject;
use App\Entities\Models\Users;
use App\Entities\Models\UsersActivities;
use App\Entities\Models\UserTestScore;
use App\Entities\Repositories\BaseRepository;
use App\Http\Responses\BaseResponse;
use App\Traits\GetUuid;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StudentServices
{

    use GetUuid;

    protected $usersRepository, $studentInviteRepository, $parentInviteRepository, $data;
    protected $relationMasterRepository, $stateRepository, $testSubjectRepository, $profileRepository;
    protected $contactMethodRepository, $activitiesRepository, $userActivitiesRepository;
    protected $studentSchoolNameRepository;
    protected $testScoreRepository, $userTestScoreRepository;

    public function __construct(Users $users, StudentInvite $studentInvite, ParentsInvite $parentsInvite, StudentParentRelation $studentParentRelation, States $states, TestSubject $testSubject, StudentsProfile $studentsProfile, ContactMethod $contactMethod, Activities $activities, UsersActivities $usersActivities, StudentSchoolName $studentSchoolName, TestScore $testScore, UserTestScore $userTestScore)
    {
        $this->usersRepository = new BaseRepository($users);
        $this->studentInviteRepository = new BaseRepository($studentInvite);
        $this->parentInviteRepository = new BaseRepository($parentsInvite);
        $this->relationMasterRepository = new BaseRepository($studentParentRelation);
        $this->stateRepository = new BaseRepository($states);
        $this->testSubjectRepository = new BaseRepository($testSubject);
        $this->profileRepository = new BaseRepository($studentsProfile);
        $this->contactMethodRepository = new BaseRepository($contactMethod);
        $this->activitiesRepository = new BaseRepository($activities);
        $this->userActivitiesRepository = new BaseRepository($usersActivities);
        $this->studentSchoolNameRepository = new BaseRepository($studentSchoolName);
        $this->testScoreRepository = new BaseRepository($testScore);
        $this->userTestScoreRepository = new BaseRepository($userTestScore);
        $this->data = [];
    }

    public function studentRegister($request)
    {
        try {
            DB::beginTransaction();
            $student = [
                'uuid' => $this->uuid(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->contact_no,
                'password' => $request->password,
                'user_type' => $request->user_type
            ];

            $checkMaxParent = $this->usersRepository->with('studentInvite')->where(['email' => $request->email, 'user_type' => AppConstant::USER_TYPE_STUDENTS])->get();
            if (sizeof($checkMaxParent) !== 0) {
                foreach ($checkMaxParent as $maxParent) {
                    if (sizeof($maxParent->studentInvite) < 2) {
                        $this->data['users'] = $this->usersRepository->create($student);
                    } else {
                        return back()->withInput();
                    }
                }
            } else {
                $this->data['users'] = $this->usersRepository->create($student);
            }
            $relation = $request->relationShip;
            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $mobileNo = $request->mobileNo;
            $emailId = $request->emailId;
            foreach ($relation as $key => $value) {
                if($value)
                {
                    $email = $emailId[$key];
                    $records = $this->usersRepository->with('parentInvite')->where(['email' => $email, 'user_type' => AppConstant::USER_TYPE_PARENTS])->get();
                    if (sizeof($records) !== 0) {

                        foreach ($records as $record) {
                            foreach ($record->parentInvite as $data) {
                                if ($data->email === $request->email) {
                                    $masterRelation = ['student_id' => $this->data['users']->id, 'parent_id' => $data->parent_id, 'relation' => $value];
                                    $this->relationMasterRepository->create($masterRelation);
                                }
                            }
                        }

                    }
                    //Add Student Invite
                    $parents = ['student_id' => $this->data['users']->id, 'relation' => $value, 'first_name' => $firstname[$key], 'last_name' => $lastname[$key], 'mobile' => $mobileNo[$key], 'email' => $emailId[$key]];
                    $studentInvite = $this->studentInviteRepository->create($parents);
                }
            }
            DB::Commit();
            Session::flash('success', __('message.student_register_success'));
            return $this->data;
        } catch (QueryException $exception) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
            print_r($exception->getMessage());
            exit();
        }

    }

    public function parentsRegister($request)
    {
        try {
            DB::beginTransaction();
            $relation = $request->relationShip;
            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $mobileNo = $request->mobileNo;
            $emailId = $request->emailId;
            $parents = ['uuid' => $this->uuid(), 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'mobile' => $request->contact_no, 'password' => $request->password, "user_type" => $request->user_type];
            $checkMaxStudent = $this->usersRepository->with('parentInvite')->where(['email' => $request->email, 'user_type' => AppConstant::USER_TYPE_PARENTS])->get();
            if (sizeof($checkMaxStudent) !== 0) {
                foreach ($checkMaxStudent as $maxStudent) {
//                    return sizeof($maxStudent->parentInvite);
                    if (sizeof($maxStudent->parentInvite) < AppConstant::PARENT_STUDENT_LIMIT) {
//                        return sizeof($maxStudent->parentInvite);
                        $this->data['users'] = $this->usersRepository->create($parents);
//                        $parentsData = $this->usersRepository->create($parents);
                    } else {
                        return back()->withInput();
                    }
                }
            } else {
                $this->data['users'] = $this->usersRepository->create($parents);
//                $parentsData = $this->usersRepository->create($parents);
            }

            foreach ($relation as $key => $value)
            {
                if($value)
                {
                    $email = $emailId[$key];
                    $records = $this->usersRepository->with('studentInvite')->where(['email' => $email, 'user_type' => AppConstant::USER_TYPE_STUDENTS])->get();
                    if (sizeof($records) !== 0) {
                        foreach ($records as $record) {
                            foreach ($record->studentInvite as $data) {
                                if ($data->email === $request->email) {
                                    $masterRelation = ['student_id' => $data->student_id, 'parent_id' => $this->data['users']->id, 'relation' => $value];
                                    $this->relationMasterRepository->create($masterRelation);
                                }
                            }
                        }

                    }
                    $students = ['parent_id' => $this->data['users']->id, 'relation' => $value, 'first_name' => $firstname[$key], 'last_name' => $lastname[$key], 'mobile' => $mobileNo[$key], 'email' => $emailId[$key]];
                    $this->data['studentInvite'] = $this->parentInviteRepository->create($students);
                }

            }
            DB::Commit();
            Session::flash('success', __('message.parent_register_success'));
            return $this->data;
        } catch (QueryException $exception) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
        }

    }

    public function getProfile($id)
    {
        $this->data['users'] = $this->usersRepository->show($id);
        $this->data['states'] = $this->stateRepository->all();
        $this->data['testType'] = $this->testSubjectRepository->all();
        $this->data['schoolName'] = $this->studentSchoolNameRepository->all();
        return $this->data;
    }

    public function studentProfileStore($request)
    {
        try {
            DB::beginTransaction();
            $test_score_type = $request->test_score_type;
            $test_scores = $request->test_scores;
            $test_score_date = $request->test_score_date;
            $studentData = ['mobile' => $request->mobilenumber, 'address1' => $request->address_1,
                'address2' => $request->address_2, 'city' => $request->city, 'state_id' => $request->timezone,
                'zipcode' => $request->pincode];
            $this->data['users'] = $this->usersRepository->update($studentData, $request->user_id);

            $checkProfileExist = $this->profileRepository->where(['user_id'=>$request->user_id])->first();
            $birthDate = Carbon::parse($request->dob)->format('Y-m-d');
            $profileData = ['user_id' => $request->user_id, 'weight' => $request->unweighted_gpa,
                'unweight' => $request->weighted_gpa, 'about_description' => $request->personality,
                'birth_date' => $birthDate, 'school_name' => $request->school_name, 'school_year' =>
                    $request->school_year, 'school_city' => $request->school_city, 'graduation_year' =>
                    $request->graduation_year, 'gender' => $request->gender_id,
                'state_id' => $request->school_state];

            if($checkProfileExist)
            {
                $this->data['studentProfile'] = $this->profileRepository->where(['user_id'=>$request->user_id])->update($profileData);
            }
            else{
                $this->data['studentProfile'] = $this->profileRepository->create($profileData);
            }
            $checkContectMethod = $this->contactMethodRepository->where(['user_id'=>$request->user_id])->first();
            $contactMethodData = ['user_id' => $request->user_id, 'mobile' => $request->mobilenumber,
                'skype_id' => $request->skype_id, 'other' => $request->other,
                'contact_by' => $request->contact_by];
            if($checkContectMethod)
            {

                $this->contactMethodRepository->update($contactMethodData,$checkContectMethod->id);
            }
            else
            {
                $this->contactMethodRepository->create($contactMethodData);
            }
            $activities = explode(',', $request->activities);
//            return $activities;
            if(sizeof($activities) > 1)
            {
                foreach ($activities as $activity) {
                    $activitydata = $this->activitiesRepository->where(['name' => $activity])->get();
                    if (sizeof($activitydata) === 0) {
                        $activitydata = $this->activitiesRepository->create(['name' => $activity]);
                        $activitiesData = ['user_id' => $request->user_id, 'activities_id' => $activitydata->id];
                        $this->userActivitiesRepository->create($activitiesData);
                    } else {
                        foreach ($activitydata as $item) {
                            $activitiesData = ['user_id' => $request->user_id, 'activities_id' => $item->id];
                        }
                        $this->userActivitiesRepository->create($activitiesData);
                    }

                }
            }

            if(!empty($test_score_type[0]) )
            {
                foreach ($test_score_type as $key=>$type)
                {
                 $date = Carbon::parse($test_score_date[$key])->format('Y-m-d');
                 $testScoreData = ['score' => $test_scores[$key], 'date' => $date, 'test_subject_id' =>$type];
                 $testScoreResponse = $this->testScoreRepository->create($testScoreData);
                 $usersScoreData = ['user_id'=>$request->user_id,'test_score_id'=>$testScoreResponse->id];
                $this->userTestScoreRepository->create($usersScoreData );
                }
            }

            DB::commit();
            Session::flash('success', __('message.student_profile_success'));
            return $this->data;
        } catch (QueryException $exception) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
        }
    }

    public function parentProfileStore($request)
    {
        try {
            DB::beginTransaction();
            $studentData = ['email' => $request->email, 'mobile' => $request->mobilenumber, 'address1' => $request->address_1, 'address2' => $request->address_2, 'city' => $request->city, 'state_id' => $request->timezone, 'zipcode' => $request->pincode];
            $this->data['users'] = $this->usersRepository->update($studentData, $request->user_id);

            $checkContectMethod = $this->contactMethodRepository->where(['user_id'=>$request->user_id])->first();
            $contactMethodData = ['user_id' => $request->user_id, 'mobile' => $request->mobilenumber,
                'skype_id' => $request->skype_id, 'other' => $request->other,
                'contact_by' => $request->contact_by];
            if($checkContectMethod)
            {
                $this->contactMethodRepository->update($contactMethodData,$checkContectMethod->id);
            }
            else
            {
                $this->contactMethodRepository->create($contactMethodData);
            }


            $activities = explode(',', $request->activities);
//            return $activities;
            if(sizeof($activities) > 1)
            {
                foreach ($activities as $activity) {
                    $activitydata = $this->activitiesRepository->where(['name' => $activity])->get();
                    if (sizeof($activitydata) === 0) {
                        $activitydata = $this->activitiesRepository->create(['name' => $activity]);
                        $activitiesData = ['user_id' => $request->user_id, 'activities_id' => $activitydata->id];
                        $this->userActivitiesRepository->create($activitiesData);
                    } else {
                        foreach ($activitydata as $item) {
                            $activitiesData = ['user_id' => $request->user_id, 'activities_id' => $item->id];
                        }
                        $this->userActivitiesRepository->create($activitiesData);
                    }

                }
            }

                DB::commit();
            Session::flash('success', __('message.parent_profile_success'));
            return $this->data;
        } catch (QueryException $exception) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
        }
    }
    public function updateProfile($request)
    {
        try {
            DB::beginTransaction();
            $id = $request->user_id;
            $this->data['user_id'] = $id;
            $file = $request->file('profile_pic');
            $user = $this->usersRepository->show($id)->first();
            $filename = $user->uuid;
            $path = $file->storeAs('user/profile/'.$user->uuid, $filename . '.' . $file->getClientOriginalExtension(), 'public');
            $data = ["image_path" => $path];
            $response = $this->usersRepository->update($data, $id);
            $this->data["path"] = url("storage/" . $path);
            DB::commit();
            $this->data['success'] = __('message.profile_add_success');
            return $this->data;
        } catch (QueryException $exception) {
            DB::rollback();
            Session::flash('error', __('auth.server_error'));
            }
    }

}