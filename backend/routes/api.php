<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\MajorController;

use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\RegisterMailcontroller;
use App\Http\Controllers\RegisterWorkShopController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolSkillController;
use App\Http\Controllers\SchoolTypeController;
use App\Http\Controllers\SchoolUserController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkShopController;



use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User side -----------------------------------------
Route::post('/users',[UserController::class, 'store']);

Route::get('/workshops',[WorkShopController::class,'getworkShops']);
Route::get('/workshop/{id}',[WorkShopController::class,'getWorkShopById']);
Route::get('/user/{id}',[UserController::class,'getUser']);
Route::put('/user/{id}',[UserController::class,'saveChange']);

// school_user
Route::get('/getSchoolUser/{id}',[SchoolUserController::class,'getSchoolUser']);
Route::put('/acceptStudent/{id}',[SchoolUserController::class,'studentAccept']);
Route::delete('/studentReject/{id}',[SchoolUserController::class,'studentReject']);
Route::get('/schools',[SchoolController::class,'getschools']);
Route::get('/schools/{id}',[SchoolController::class,'getschool']);
Route::get('/schools/address/{name}',[SchoolController::class,'search']);
Route::post('/schools',[SchoolController::class,'createSchool']);
Route::put('/schools/{id}',[SchoolController::class,'editeSchool']);
Route::delete('/schools/{id}',[SchoolController::class,'deleteSchool']);

// scholarship rounte
Route::get('/scholarships',[ScholarshipController::class,'getAllscholarships']);
Route::get('/scholarships/{school_id}',[ScholarshipController::class,'scholarships']);
Route::get('/scholarships/edit/{id}',[ScholarshipController::class,'scholarship']);
Route::delete('/scholarships/{id}',[ScholarshipController::class,'destroy']);
Route::post('/addScholarships',[ScholarshipController::class,'store']);
Route::put('/editScholarships/{id}',[ScholarshipController::class,'editScholarship']);

// major route
Route::get('/majors',[SkillController::class,'getSkills']);
Route::get('/majors/school/{id}',[SkillController::class,'SkillsInSchool']);
Route::get('/majors/{id}',[SkillController::class,'getSkillById']);
Route::post('/majors',[SkillController::class,'store']);
Route::put('/majors/{id}',[SkillController::class,'editeSkill']);
Route::delete('/majors/{id}',[SkillController::class,'deleteSkill']);


// major with school
Route::post("/schoolMajor",[SchoolSkillController::class,'store']);

// Admin side --------------------------------
Route::get('/users', [AdminController::class, 'index']);
Route::get('/user/{id}', [AdminController::class, 'getUser']);
Route::put('/user/{id}', [AdminController::class, 'updateUser']);
Route::delete('/user/{id}', [AdminController::class, 'destroy']);
Route::get('/students', [AdminController::class, 'getStudents']);
Route::get('/managers', [AdminController::class, 'getUniversityDirectors']);


// log in and log out
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logOut', [AuthenticationController::class, 'logout']);
});
Route::post('/logIn', [AuthenticationController::class,'login']);

// Create link image from front-end
Route::post('/image',[SkillController::class,'createImageLink']);

// subject route
Route::get('/subjects',[SkillController::class,'getSubjects']);

//Address route
Route::get('/addresses', [AddressController::class, 'index']);


// Major route
Route::get('/workshops',[WorkShopController::class,'getWorkShops']);
Route::get('workshops/school/{id}',[WorkShopController::class,'getworkShopsInSchool']);
Route::get('/workshops/{id}',[WorkShopController::class,'getWorkShopById']);
Route::post('/workshops',[WorkShopController::class,'createWorkshop']);
Route::put('/workshops/{id}',[WorkShopController::class,'editeWorkShop']);
Route::delete('/workshops/{id}',[WorkShopController::class,'deleteWorkShop']);
Route::patch('/resetPassword',[ResetPasswordController::class,'resetPassword']);
Route::post('/sendMail',[ResetPasswordController::class,'SendMail']);

// university page register 
Route::post('/registerMail',[UserController::class,'sendEmail']);

// get user that already register in workshop
Route::post('/registerWorkShop', [RegisterWorkShopController::class, 'registerWorkShop']);
Route::get('/getregisterWorkShop', [RegisterWorkShopController::class, 'index']);
// Address 
// Route::get('/addresses',[AddressController::class,'addresses']);
// education type
Route::get("/schoolType",[SchoolTypeController::class,'schoolType']);

// get user Id
Route::get('/getUserId/{email}',[UserController::class,'getUserId']);

// create university
Route::post('/school',[SchoolController::class,'store']);
Route::get('/getSchoolIdByName/{name}',[SchoolController::class,'getSchoolIdByName']);

// applay for study
Route::post('/apply',[SchoolUserController::class,'store']);


// create address
Route::post('/address',[AddressController::class,'store']);
Route::get('/getTypeId/{name}',[SchoolTypeController::class,'getIdTypeOfSchool']);
