<?php

/**
 * Created by PhpStorm.
 * User: KameR <kashyapk62@gmail.com>
 * Date: 12-05-2018
 * Time: 03:05PM
 */


namespace App\AppConstant;

class AppConstant {
    // AppConstant Status
    const STATUS_FAIL = 'fail';
    const STATUS_OK = 'ok';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const USER_TYPE_STUDENTS = 1;
    const USER_TYPE_PARENTS = 2;

    const STUDENT_PARENT_LIMIT = 2;
    const PARENT_STUDENT_LIMIT = 3;

    const USER_GUARD = 'user';

    const QUESTION_DURATIONALANSWER = 1;
    const QUESTION_LISTANSWER = 2;
    const QUESTION_DETAILANSWER = 3;
}