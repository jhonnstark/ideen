<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\Course as CourseResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $validated = $request->except(['poster']);
        $course = Course::create($validated);
        $name = $course->id . '_course_poster.' . $request->poster->getClientOriginalExtension();

        $poster = Image::make($request->poster)->fit(100)->encode();
        $posteBig = Image::make($request->poster)->fit(960, 200)->encode();
        Storage::disk('s3')->put('poster/' . $name, $poster->__toString(), 'public');
        Storage::disk('s3')->put('poster_big/' . $name, $posteBig->__toString(), 'public');

        $course->poster = $name;
        $course->save();

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
     * @param Course $course
     * @return CourseResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Course $course)
    {
        $role = $this->role['role'];
        $id = $course->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Course $course
     * @return CourseResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showJson(Request $request, Course $course)
    {
        if ($request->wantsJson()) {
            return new CourseResource($course->load('teacher'));
        }
        return response();
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
