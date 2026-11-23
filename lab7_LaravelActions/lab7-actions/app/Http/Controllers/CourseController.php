<?php

namespace App\Http\Controllers;

use App\Actions\DeleteCourseAction;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $course = Course::query()
            ->when($request->has('search'), fn ($query) => $query->where('title', 'like', '%'.$request->get('search').'%'))
            ->latest()
            ->get(['id', 'title', 'level', 'start_date', 'seats']);

        return response()->json($course);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $course = Course::query()
            ->create($request->validated());

        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('enrollments');

        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, DeleteCourseAction $action)
    {
        $action->handle($course);

        return response()->json([
            'message' => 'Course deleted successfully.'
        ]);
    }
}
