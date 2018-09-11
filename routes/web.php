<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function (){
    return redirect('login');
});

Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function (){
    Route::get('/','RegisterController@index');
    Route::post('/register','RegisterController@register')->name('student.register');
    Route::post('/perentsregister','RegisterController@parentsregister')->name('parents.register');
    Route::get('/profile/{id}','RegisterController@studentProfile')->name('student.profile');
    Route::post('/student-profile-store','RegisterController@studentProfileStore')->name('student.profileStore');
    Route::post('/parent-profile-store','RegisterController@parentProfileStore')->name('parent.profileStore');
    Route::post('/studentProfilePicture','RegisterController@studentProfilePicture')->name('studentProfilePicture');
});

Route::group(['middleware' => 'auth.check.admin'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('dashboard', function () {
        return view('users.dashboard');
    })->name('user.dashboard');

    Route::group(['prefix' => 'user/writeit', 'namespace' => 'User'], function (){
        Route::get('/', 'WriteITController@writeITIndex')->name('writeit.index');
        Route::get('overall_goals', 'WriteITController@writeITOverallGoal')->name('writeit.overallgoal');
        Route::get('overall_goals/extracurriculars', 'WriteITController@writeITExtracurriculars')->name('writeit.overallgoal.extracurriculars');
        Route::post('overall_goals/extracurriculars/saveExtracurriculars', 'WriteITController@saveExtracurriculars')->name('writeit.overallgoal.saveExtracurriculars');
        Route::post('overall_goals/detailQuestion/saveUserDetailQuestion', 'WriteITController@saveUserDetailAnswer')->name('writeit.overallgoal.saveDetailQuestion');
        Route::post('overall_goals/personalQuestion/saveUserPersonalQuestion', 'WriteITController@saveUserPersonalQuestion')->name('writeit.overallgoal.saveUserPersonalQuestion');
    });

});

Route::get('essay-prompt', function () {
	return view('writeIt.essayPrompts.index');
});
Route::get('/more-successful-essays', function () {
	return view('writeIt.essayPrompts.more-successful-essay');
});
Route::get('/lets-write-it', function () {
	return view('writeIt.essayPrompts.lets-write-it');
});
Route::get('/draft-essays', function () {
	return view('writeIt.essayPrompts.draft-essays');
});
Route::get('/tips-and-advice', function () {
	return view('tipsAndAdvice.index');
});
