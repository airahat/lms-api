<?php


use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CourseStatusController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\LessonController;

Route::post('/chat', [ChatController::class, 'chat']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('roles', RoleController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('users', UserController::class);
Route::get('/trainers', [UserController::class, 'getTrainers']);
Route::get('/students', [UserController::class, 'getStudents']);
Route::apiResource('lessons', LessonController::class);
// Fetch lessons by course
Route::get('/courses/{id}/lessons', [LessonController::class, 'lessonsByCourse']);





Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('/course-statuses', CourseStatusController::class);
});
