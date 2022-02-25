<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\TeacherCollection;
use App\Models\Teacher;
use App\Http\Resources\Teacher as TeacherResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TeacherController extends Controller
{
    /**
     * MaterialController instance.
     */
    private $materialController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->materialController = new MaterialController();
    }

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'teacher', 'type' => 'personnel'];

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
     * @return TeacherCollection
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
        $type = $this->role['type'];
        return view('admin.edit', compact('role', 'id', 'type'));
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
        $teacher->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Update teacher'
        ]);
    }

    /**
     * Show a new certificate
     *
     * @param Teacher $teacher
     * @return Application|Factory|View
     */
    public function certificateView(Teacher $teacher)
    {
        $date = now()->locale('es')->isoFormat('LL');
        $teacher['year'] = $teacher->created_at->year;
        return view('work_proof', $teacher)->with('date', $date);
    }

    /**
     * Store a new certificate in the S3
     *
     * @param Teacher $teacher
     * @return TeacherResource
     */
    public function certificate(Teacher $teacher): TeacherResource
    {
        $teacher['year'] = $teacher->created_at->year;
        $storeCertificate = $this->materialController->storeCertificate($this->role['role'], $teacher->toArray());
        $teacher->material()->create($storeCertificate);
        return new TeacherResource($teacher);
    }

    /**
     * Show the certificate in the S3
     *
     * @param Teacher $teacher
     * @return StreamedResponse
     */
    public function download(Teacher $teacher): StreamedResponse
    {
        $material = $teacher->material()->first();
        return Storage::disk('s3')->download($material->url);
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
