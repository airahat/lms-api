<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    return response()->json([
        'lessons' => Lesson::with('course')
            ->orderBy('course_id')
            ->orderBy('lesson_order')
            ->get()
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'video_url' => 'nullable|url',
    ]);

    $nextOrder = Lesson::where('course_id', $request->input('course_id'))
        ->max('lesson_order') + 1;

    Lesson::create([
        'course_id'   => $request->input('course_id'),
        'title'       => $request->input('title'),
        'content'     => $request->input('content'),
        'video_url'   => $request->input('video_url'),
        'lesson_order'=> $nextOrder,
    ]);

    return response()->json([
        'message' => 'Lesson created successfully'
    ], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function lessonsByCourse($id)
{
    // Ensure the relationship exists
    $lessons = Lesson::with('course')
        ->where('course_id', $id)
        ->orderBy('lesson_order')
        ->get();

    return response()->json([
        'lessons' => $lessons
    ]);
}

}
