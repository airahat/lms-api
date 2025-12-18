<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $courses = Course::select(
            'courses.id',
            'courses.course_code',
            'courses.title',
            'courses.description',
            'courses.duration',
            'u.id as trainer_id',
            'u.name as trainer_name'
        )
        ->join('users as u', 'courses.trainer_id', '=', 'u.id')
        ->get();

    return response()->json([
        "message" => "Courses retrieved successfully",
        "courses" => $courses
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = Course::create([
            'course_code' => $request->course_code,
            'title' => $request->title,
            'description' => $request->description,
            'trainer_id' => $request->trainer_id,
            'duration' => $request->duration,
        ]);
        return response()->json([
            "message" => "Course created successfully",
            "course" => $course
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('trainer:id,name,role_id')->find($id);

        if(!$course){
            return response()->json([
                'message'=> 'Course not found'
            ], 404);
        }

        return response()->json([
            "message" => "Course retrieved successfully",
            "course" => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
