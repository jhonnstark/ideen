<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\UserCollection;
use App\Models\Course;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Course as CourseResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
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
     * @return View
     */
    public function index(): View
    {
        return view('admin.list', $this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return CourseCollection
     */
    public function list(): CourseCollection
    {
        return new CourseCollection(Course::with('teacher')->withCount('student')->get());
    }

    /**
     * Display a register form of the resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.register', $this->role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return JsonResponse
     */
    public function store(CourseRequest $request): JsonResponse
    {
        $validated = $request->except(['poster']);
        $course = Course::create($validated);
        if ($request->has('teacher_id')) {
            $course->teacher()->attach($request->teacher_id);
        }

        $name = $course->id . '_course_poster.' . $request->poster->getClientOriginalExtension();

        $poster = Image::make($request->poster)->fit(100)->encode();
        $posteBig = Image::make($request->poster)->fit(960, 200)->encode();
        Storage::disk('s3')->put('poster/' . $name, $poster->__toString(), 'public');
        Storage::disk('s3')->put('poster_big/' . $name, $posteBig->__toString(), 'public');

        $course->poster = $name;
        $course->save();

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return Application|Factory|View
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
     * @return Application|CourseResource
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
     * @param CourseUpdateRequest $request
     * @param Course $course
     * @return JsonResponse
     */
    public function update(CourseUpdateRequest $request, Course $course): JsonResponse
    {
        $validated = $request->except(['poster']);
        $course->update($validated);
        $ids = $request->has('teacher_id')
            ? [ $request->teacher_id ]
            : [];
        $course->teacher()->sync($ids);

        if ($request->has('poster'))
        {
            $name = $course->id . '_course_poster.' . $request->poster->getClientOriginalExtension();

            $poster = Image::make($request->poster)->fit(100)->encode();
            $posteBig = Image::make($request->poster)->fit(960, 200)->encode();
            Storage::disk('s3')->put('poster/' . $name, $poster->__toString(), 'public');
            Storage::disk('s3')->put('poster_big/' . $name, $posteBig->__toString(), 'public');

            $course->poster = $name;
            $course->save();
        }

        return response()->json([
            'status' => 201,
            'message' => 'Updated user'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Course $course): JsonResponse
    {
        $course->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Course'
        ],204 );
    }

    /**
     * Loads the students of a course.
     *
     * @param Course $course
     * @return UserCollection
     */
    public function students(Course $course): UserCollection
    {
        $course->load('student');
        return new UserCollection($course->student);
    }
}
