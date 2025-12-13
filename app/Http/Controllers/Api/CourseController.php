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
        $courses= Course::all();
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
            'trainer' => $request->trainer,
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
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                "message" => "Course not found"
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
