<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Resources\Course;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\TeacherCollection;
use App\Models\Teacher;
use App\Http\Resources\Teacher as TeacherResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class TeacherController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'teacher'];

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
     * @return
     */
    public function list(): TeacherCollection
    {
        return new TeacherCollection(Teacher::all());
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
     * @param Teacher $teacher
     * @return CourseCollection
     */
    public function courses(Teacher $teacher): CourseCollection
    {
        $teacher->load('courses');
        $courses = $teacher->courses->loadCount('student');
        return new CourseCollection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $request
     * @return JsonResponse
     */
    public function store(TeacherRequest $request): JsonResponse
    {
        $record = $request->all();
        $record['password'] = Hash::make($record['password']);
        Teacher::create($record);
        return response()->json([
            'status' => 201,
            'message' => 'created teacher',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Teacher $teacher
     * @return TeacherResource|Application|Factory|View
     */
    public function show(Request $request, Teacher $teacher)
    {
        if ($request->wantsJson()) {
            return new TeacherResource($teacher);
        }
        $role = $this->role['role'];
        $id = $teacher->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherUpdateRequest $request
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function update(TeacherUpdateRequest $request, Teacher $teacher): JsonResponse
    {
        $teacher->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update teacher'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function detach(Request $request, Teacher $teacher): JsonResponse
    {
        $teacher->courses()->detach($request->input('id'));
        return response()->json([
            'status' => 200,
            'message' => 'Update teacher'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Teacher $teacher): JsonResponse
    {
        $teacher->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted teacher'
        ],204 );
    }
}
