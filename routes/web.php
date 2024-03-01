<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
// use App\Http\Controllers\ApiStudentController;


// Route::get('/', function () {
//     echo UC('umer');
//     // return view('welcome');
// });
Route::get('generate', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
      // \Illuminate\Support\Facades\Artisan::call('cache:clear');
      // \Illuminate\Support\Facades\Artisan::call('config:clear');
      // echo 'ok';exit;
  });


//  For Login/ Logout
Auth::routes();

// Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);

Route::get('/logout', [HomeController::class, 'logout']);

// Api
// Route::get('/students', [ApiStudentController::class, 'index']);
// Route::post('/students', [ApiStudentController::class, 'store']);

// For Student Crud

Route::group(['middleware' => 'auth'],function(){
    Route::get('/form', [StudentController::class, 'index']);
    Route::post('/form', [StudentController::class, 'store']);
    Route::get('/student/show',[StudentController::class, 'show']);
    Route::get('/student/edit/{id}',[StudentController::class,'edit']);
    Route::post('/student/update/{id}',[StudentController::class,'update']);
    Route::get('/student/delete/{id}',[StudentController::class,'delete']);
});

// For Course Crud

Route::group(['middleware' => 'auth'],function(){
    Route::get('/course/form', [CourseController::class, 'index']);
    Route::post('/course/form', [CourseController::class, 'store']);
    Route::get('/course/show',[CourseController::class, 'show']);
    Route::get('/course/edit/{id}',[CourseController::class,'edit']);
    Route::post('/course/update/{id}',[CourseController::class,'update']);
    Route::get('/course/delete/{id}',[CourseController::class,'delete']);
    
});