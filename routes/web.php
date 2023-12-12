<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;

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

// Route::get('/', function () {
//     return view('welcome');
// });


 Route::get('/Users',[UserController::class,'getData']);
 Route::get('/JobsDB',[UserController::class,'getJob']);
 Route::get('/DashboardData',[UserController::class,'getData']);
 Route::post('/UsersData',[UserController::class,'addData']);
 Route::post('/LoginUser',[UserController::class,'loginUser']);
 Route::post('/jobData',[UserController::class,'postJob']);
 Route::post('/newCategory',[UserController::class,'addNewCategory']);
 Route::post('/deleteCategory',[UserController::class,'deleteCategory']);
 Route::post('/updateCategory',[UserController::class,'updateCategory']);
 Route::get('/getCategory',[UserController::class,'getAllCategory']);
 Route::post('/getjobDB',[UserController::class,'getJobfromDB']);
 Route::post('/getProfile',[UserController::class,'getUserProfile']);
 Route::post('/restoreUser',[UserController::class,'updateData']);
 Route::post('/updateUserDetails',[UserController::class,'updateUserData']);
 Route::post('/removeUser',[UserController::class,'removeData']);
 Route::post('/updateProfile',[UserController::class,'updateUserProfile']);
 Route::post('/rejectJob',[UserController::class,'rejectJob']);
 Route::post('/bidJob',[UserController::class,'bidJob']);
 Route::post('/bidJobGet',[UserController::class,'bidJobGet']);
 Route::post('/bidProfile',[UserController::class,'bidprofile']);
 Route::post('/ratings',[UserController::class,'rating']);
 Route::post('/ratingsGet',[UserController::class,'getrating']);