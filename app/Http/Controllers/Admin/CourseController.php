<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\Course as CourseResource;

class CourseController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'course'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.list', $this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function list()
    {
        return new CourseCollection(Course::with('teacher')->withCount('student')->get());
    }

    /**
     * Display a register form of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.register', $this->role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CourseRequest $request)
    {
        $course = Course::create($request->validated());
        if ($request->has('teacher_id')) {
            $course->teacher()->attach($request->teacher_id);
        }
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Course $course
     * @return CourseResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Course $course)
    {
        if ($request->wantsJson()) {
            return new CourseResource($course->load('teacher'));
        }
        $role = $this->role['role'];
        $id = $course->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());
        $ids = $request->has('teacher_id')
            ? [ $request->teacher_id ]
            : [];
        $course->teacher()->sync($ids);
        return response()->json([
            'status' => 200,
            'message' => 'Updated user'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Course'
        ],204 );
    }
}
