<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Models\Course;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ExamController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'exam'];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
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
        return new ExamCollection(Exam::with('teacher')->with('course')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     *
     * @return Application|Factory|View
     */
    public function create(Course $course)
    {
        return view('components.examForm')
            ->with('course', $course->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExamRequest $request
     *
     * @return JsonResponse
     */
    public function store(ExamRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $teacher = Course::find($validated['course_id'])->teacher->first();
        $validated['teacher_id'] = $teacher->id;
        return response()->json([
            'status' => 201,
            'message' => 'created',
            'data' => Exam::create($validated)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Exam $exam
     *
     * @return Application|Factory|View
     */
    public function show(Exam $exam)
    {
        $exam->load('course');
        return view('components.examForm')
            ->with('course', $exam->course->id)
            ->with('id', $exam->id);
    }


    /**
     * Display the specified resource.
     *
     * @param Exam $exam
     * @return ExamResource
     */
    public function showJson(Exam $exam): ExamResource
    {
        return new ExamResource($exam);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Exam $exam
     * @return void
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Exam $exam
     * @return void
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exam $exam
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Exam $exam): JsonResponse
    {
        $exam->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Course'
        ],204 );
    }
}
