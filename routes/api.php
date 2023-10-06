<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//get all students
Route::get('/students', [StudentController::class , 'index' ]);
//get student by id
Route::get('/student/{id}', [StudentController::class , 'show' ]);


//get all courses
Route::get('/courses', [CourseController::class , 'index' ]);
//get course by id
Route::get('/course/{id}', [CourseController::class , 'show' ]);

Route::group(['prefix' => 'auth'], function () {
    //login
    Route::post('login', [AuthController::class, 'login']);
    //register
    Route::post('register', [AuthController::class, 'register']);

    //laravel passport auth
    Route::group(['middleware' => 'auth:api'], function() {
        //logout
        Route::get('logout', [AuthController::class, 'logout']);
        //create new student
        Route::post('/student/create', [StudentController::class , 'store' ]);
        //delete student
        Route::delete('/student/delete/{id}', [StudentController::class , 'destroy' ]);

        //create new course
        Route::post('/course/create', [CourseController::class , 'store' ]);
        //delete course
        Route::delete('/course/delete/{id}', [CourseController::class , 'destroy' ]);
    });
});





