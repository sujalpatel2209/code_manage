<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 14/8/18
 * Time: 4:58 PM
 */

namespace App\Entities\Services;


use App\AppConstant\AppConstant;
use App\Entities\Models\CollegeYears;
use App\Entities\Models\UserDetailQuestionAnswer;
use App\Entities\Models\UserPersonalAnswer;
use App\Entities\Models\UserQuestionAnswer;
use App\Entities\Models\UserWriteITQuestionAnswer;
use App\Entities\Models\WriteITDetailQuestion;
use App\Entities\Models\WriteITPersonalQuestion;
use App\Entities\Models\WriteITQuestion;
use App\Entities\Repositories\BaseRepository;
use App\Traits\GetUuid;
use Illuminate\Support\Facades\Auth;


class WriteITServices
{

    use GetUuid;

    protected $data, $writeITQuestion, $userWriteITQuestion, $writeITDetailQuestion, $userQuestionAnswer, $userDetailQueAns, $writeITPersonalQuestion, $userPersoanlQueAns, $collegeYear;

    public function __construct()
    {
        $this->writeITQuestion = new BaseRepository(new WriteITQuestion());
        $this->userWriteITQuestion = new BaseRepository(new UserWriteITQuestionAnswer());
        $this->writeITDetailQuestion = new BaseRepository(new WriteITDetailQuestion());
        $this->userQuestionAnswer = new BaseRepository(new UserQuestionAnswer());
        $this->userDetailQueAns = new BaseRepository(new UserDetailQuestionAnswer());
        $this->writeITPersonalQuestion = new BaseRepository(new WriteITPersonalQuestion());
        $this->userPersoanlQueAns = new BaseRepository(new UserPersonalAnswer());
        $this->collegeYear = new BaseRepository(new CollegeYears());
        $this->data = [];
    }

    public function getWriteQuestion()
    {
        $this->data = $this->writeITQuestion->all();
        $this->data->collegeyear = $this->collegeYear->all();
        return $this->data;
    }

    public function saveWriteItQuestion($request)
    {
        $user = Auth::guard(AppConstant::USER_GUARD)->user();
        $userId = $user->id;

        $this->userQuestionAnswer->whereDelete(array('user_id' => $userId));
        $this->userWriteITQuestion->whereDelete(array('user_id' => $userId));

        for ($i = 0; $i < count($request['questionId']); $i++) {

            $questionData = $this->writeITQuestion->where(array(
                'uuid' => $request['questionId'][$i]
            ))->first();

            $questionId = $questionData->id;
            $questionType = $questionData->question_type;


            for ($j = 0; $j < count($request['name'][$i]); $j++) {

                switch ($questionType) {
                    case AppConstant::QUESTION_DURATIONALANSWER:
                        if ($request['name'][$i][$j] != "" && $request['position'][$i][$j] != "") {

                            $check = $this->userQuestionAnswer->where(array(
                                'user_id' => $userId,
                                'writeit_question_id' => $questionId
                            ))->first();

                            if ($check == "") {
                                $userQueAnsArray = array(
                                    'user_id' => $userId,
                                    'writeit_question_id' => $questionId
                                );

                                $latestId = $this->userQuestionAnswer->create($userQueAnsArray);
                                $queAnsId = $latestId->id;
                            } else {

                                $queAnsId = $check->id;
                            }

                            $dataArray = array(
                                'user_id' => $userId,
                                'user_que_ans_id' => $queAnsId,
                                'answer' => $request['name'][$i][$j],
                                'college_year_id' => $request['college_year'][$i][$j],
                                'answer2' => $request['position'][$i][$j]
                            );

                            $this->userWriteITQuestion->create($dataArray);
                        }
                        break;
                    case AppConstant::QUESTION_LISTANSWER:
                        if ($request['name'][$i][$j] != "") {
                            $check = $this->userQuestionAnswer->where(array(
                                'user_id' => $userId,
                                'writeit_question_id' => $questionId
                            ))->first();

                            if ($check == "") {
                                $userQueAnsArray = array(
                                    'user_id' => $userId,
                                    'writeit_question_id' => $questionId
                                );

                                $latestId = $this->userQuestionAnswer->create($userQueAnsArray);
                                $queAnsId = $latestId->id;
                            } else {

                                $queAnsId = $check->id;
                            }

                            $dataArray = array(
                                'user_id' => $userId,
                                'user_que_ans_id' => $queAnsId,
                                'answer' => $request['name'][$i][$j]
                            );

                            $this->userWriteITQuestion->create($dataArray);
                        }
                        break;
                    case AppConstant::QUESTION_DETAILANSWER:
                        if ($request['name'][$i][$j] != "") {

                            $check = $this->userQuestionAnswer->where(array(
                                'user_id' => $userId,
                                'writeit_question_id' => $questionId
                            ))->first();

                            if ($check == "") {
                                $userQueAnsArray = array(
                                    'user_id' => $userId,
                                    'writeit_question_id' => $questionId
                                );

                                $latestId = $this->userQuestionAnswer->create($userQueAnsArray);
                                $queAnsId = $latestId->id;
                            } else {

                                $queAnsId = $check->id;
                            }

                            $dataArray = array(
                                'user_id' => $userId,
                                'user_que_ans_id' => $queAnsId,
                                'answer' => $request['name'][$i][$j]
                            );

                            $this->userWriteITQuestion->create($dataArray);
                        }
                        break;
                }
            }
        }
        $this->data = $this->userQuestionAnswer->with(['userWriteITAnswer'])->where(array(
            'user_id' => $userId
        ))->get();
        $this->data->detailQuestion = $this->writeITDetailQuestion->where(array(
            'status' => AppConstant::STATUS_ACTIVE
        ))->get();
        return $this->data;
    }

    public function saveUserDetailAnswer($request)
    {
        for ($i = 0; $i < count($request['user_que_ans_id']); $i++) {

            $userQueAnsId = $request['user_que_ans_id'][$i];

            $detailQuestion = $this->writeITDetailQuestion->where(array(
                'uuid' => $request['detailQuesId'][$i]
            ))->first();

            $detailQueId = $detailQuestion->id;

            $this->userDetailQueAns->whereDelete(array('user_que_ans_id' => $userQueAnsId));

            foreach ($request['text_area1'] as $ans) {

                $dataArray = array(
                    'user_que_ans_id' => $userQueAnsId,
                    'detail_question_id' => $detailQueId,
                    'answer' => $ans[$i]
                );
                $this->userDetailQueAns->create($dataArray);
            }
        }

        $this->data = $this->writeITPersonalQuestion->where(array(
            'status' => AppConstant::STATUS_ACTIVE
        ))->get();

        return $this->data;
    }

    public function saveUserPersonalAnswer($request)
    {
        $userId = Auth::guard(AppConstant::USER_GUARD)->user()->id;
        $this->userPersoanlQueAns->whereDelete(array('user_id' => $userId));
        for ($i = 0; $i < count($request['personal_que_id']); $i++) {

            $userPersonalQueId = $request['personal_que_id'][$i];

            $personalQuestion = $this->writeITPersonalQuestion->where(array(
                'uuid' => $userPersonalQueId
            ))->first();

            $personalQueId = $personalQuestion->id;

            $dataArray = array(
                'user_id' => $userId,
                'personal_question_id' => $personalQueId,
                'answer' => $request['text_area1'][$i]
            );

            $this->userPersoanlQueAns->create($dataArray);
        }
    }
}