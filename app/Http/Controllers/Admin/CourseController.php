<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseCollection;
use App\Models\Activity;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\Course as CourseResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @return ActivityResource
     */
    public function activity(Course $course)
    {
        $course->load('activity');
        return new ActivityResource($course->activity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */
    public function activityAdd(Course $course)
    {
        return view('admin.register')
            ->with('role', 'activity')
            ->with('course', $course->id);
    }

    /**
     * Store a newly created resource in storage.
     * @param ActivityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activityRegister(ActivityRequest $request)
    {
        $validated = $request->validated();
        $validated['active'] = $validated['active'] === 'true';
        $activity = Activity::create($validated);
        $activity->material()->create($this->createMaterial($request, 'activity'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @return ContentResource
     */
    public function content(Course $course)
    {
        $course->load('content');
        return new ContentResource($course->content);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contentAdd(Course $course)
    {
        return view('admin.register')
            ->with('role', 'content')
            ->with('course', $course->id);
    }

    /**
     * Store a newly created resource in storage.
     * @param ActivityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contentRegister(ActivityRequest $request)
    {
        $validated = $request->validated();
        $validated['active'] = $validated['active'] === 'true';
        $content = Content::create($validated);
        $content->material()->create($this->createMaterial($request, 'content'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $type
     * @return array
     */
    private function createMaterial(Request $request, $type) {
        $course = Course::find($request->input('course_id'));
        $name = $course->id . '_' . $type . '_' . $request->material->getClientOriginalName();

        return [
            'size' => $request->material->getSize(),
            'url' => Storage::disk('s3')->putFileAs('material', $request->material, $name),
            'ext' => $request->material->getClientOriginalExtension(),
            'name' => $name,
            'admin_id' => Auth::id()
        ];
    }

}
