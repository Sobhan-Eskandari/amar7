<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    /*
     *  Routes which only admin can access
     */
    Route::group(['middleware'=>'AdminRole'],function (){

        /*
         *  dashboard reports route
         */
        Route::resource('/reports','ReportsController');

        /*
         *  dashboard share route
         */
        Route::resource('/share', 'ShareController');
        Route::get('/share-search', 'ShareController@SearchShares')->name('share.Search');

        /*
         *  dashboard wiki routes
         */
        Route::resource('/wiki', 'WikiController');
        Route::get('/wiki-search', 'WikiController@SearchWiki')->name('wiki.Search');

        /*
         *  dashboard wiki categories routes
         */
        Route::resource('/wiki-categories', 'WikiCategoriesController');
        Route::get('/wiki-categories-search', 'WikiCategoriesController@SearchCategories')->name('wiki-categories.Search');

        /*
         *  dashboard users routes
         */
        Route::resource('/users', 'UserController');
        Route::get('/users-search', 'UserController@SearchUsers')->name('users.search');

        /*
         *  dashboard courses routes
         */
        Route::resource('courses-categories','CoursesCategoriesController');
        Route::get('/courses-categories-search', 'CoursesCategoriesController@search')->name('courses-categories.Search');

        /*
         *  dashboard update admin info like name, image,... routes
         */
        Route::get('/admin-info', 'SiteController@adminInfo')->name('adminInfo');
        Route::put('/admin-info/{admin_info}', 'SiteController@updateAdminInfo')->name('adminInfo.update');

        /*
         *  dashboard messages routes
         */
        Route::resource('messages','MessageController');
        Route::get('messages-search','MessageController@search')->name('Message-search');
        Route::post('answerMessage','MessageController@answerMessage')->name('answer');

        /*
         *  dashboard settings route
         */
        Route::resource('settings','settingsController');

        /*
         *  dashboard lessons routes
         */
        Route::resource('lessons','LessonController');
        Route::get('lessons-search','LessonController@search')->name('lessons.search');

        /*
         *  dashboard sessions of the lessons routes
         */
        Route::get('sessions/lessons/{id}','SessionController@create')->name('sessions.create');
        Route::post('sessions/lessons/{id}','SessionController@store')->name('sessions.store');
        Route::get('sessions/{session_id}/lessons/{id}','SessionController@edit')->name('sessions.edit');
        Route::patch('sessions/{session_id}/lessons/{id}','SessionController@update')->name('sessions.update');
        Route::delete('sessions/{session_id}/{id}','SessionController@destroy')->name('sessions.delete');

    });

    /*
     *  Routes which only normal users can access
     */
    Route::group(['middleware'=>'UserRole'],function(){

        /*
         *  cart of user route
         */
        Route::get('/cart', 'UserDashboardController@cart')->name('cart');

        /*
         *  user dashboard update info routes
         */
        Route::get('/user-info', 'UserDashboardController@info')->name('user-info');
        Route::put('/user-info/{user_info}', 'UserDashboardController@UpdateInfo')->name('user-info.update');

        /*
         *  user dashboard all bought courses routes
         */
        Route::get('/user-courses', 'UserDashboardController@courses')->name('user-courses');
        Route::get('/user-courses/{user_courses}', 'UserDashboardController@sessions')->name('user-sessions');

        /*
         *  user dashboard update password routes
         */
        Route::get('/user-password', 'UserDashboardController@password')->name('user-password');
        Route::put('/user-password/{user_password}', 'UserDashboardController@UpdatePassword')->name('user-password.update');

        /*
         *  routes which only users can add, remove and buy courses
         */
        Route::post('add-to-card/{id}','UserDashboardController@addToCart')->name('addToCart');
        Route::delete('add-to-card/{id}','UserDashboardController@removeFromCart')->name('removeFromCart');
        Route::post('bought','UserDashboardController@bought')->name('bought');
    });



});

/*
 *  routes accessible by all kinds of users
 */
Route::get('/', 'SiteController@index')->name('home');

Auth::routes();

Route::get('/wiki/{wiki}', 'WikiController@show')->name('wiki.show');

Route::get('lessons/{lesson}','LessonController@show')->name('lessons.show');

Route::get('course-category/{course_category}', 'SiteController@CourseCategory')->name('CourseCategory');

Route::get('wiki-category/{wiki_category}', 'SiteController@WikiCategory')->name('WikiCategory');

Route::get('/about-us', 'SiteController@AboutUs')->name('aboutUs');

Route::get('/all-courses', 'SiteController@AllCourses')->name('allCourses');

Route::get('/search-results','SiteController@search')->name('search-results');

Route::get('register/verify/{token}', 'Auth\RegisterController@verify');

Route::get('/all-wiki', 'WikiController@AllWiki')->name('allWiki');

Route::get('contact-us','MessageController@create')->name('contact-us');

Route::post('contact-us','MessageController@store')->name('contact-us.sendMessage');

Route::get('sessions/{id}','SessionController@show')->name('sessions.show');