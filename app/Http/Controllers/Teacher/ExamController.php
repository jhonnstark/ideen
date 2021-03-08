<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\FinishScoreRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ScoreResource;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Module;
use App\Models\Score;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Exception;

class ExamController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'exam'];

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     *
     * @return ExamCollection
     */
    public function exam(Course $course): ExamCollection
    {
        $course->load('exam');
        return new ExamCollection($course->exam);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Module $module
     *
     * @return ExamCollection
     */
    public function examModule(Module $module): ExamCollection
    {
        $module->load('exams');
        return new ExamCollection($module->exams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Exam $exam
     *
     * @return View
     */
    public function gradeExam(Exam $exam): View
    {
        return view('teacher.gradeExam', ['id' => $exam->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Exam $exam
     *
     * @return ExamResource
     */
    public function getGradesExam(Exam $exam): ExamResource
    {
        $exam->load('scores.user');
        return new ExamResource($exam);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Score $score
     * @return View
     */
    public function getScores(Score $score): View
    {
        return view('teacher.score', ['id' => $score->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Score $score
     *
     * @return ScoreResource
     */
    public function getScoresJson(Score $score): ScoreResource
    {
        $score->load(['exam.questions.claims', 'exam.questions.answers']);
        return new ScoreResource($score);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Score $score
     * @param FinishScoreRequest $request
     *
     * @return JsonResponse
     */
    public function finishScores(Score $score, FinishScoreRequest $request): JsonResponse
    {
        $score->mark = $request->input('mark');
        $score->save();
        return response()->json([
            'status' => 201,
            'message' => 'Finished',
        ], 201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('teacher.list', $this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function list()
    {
        $exams = Exam::where('teacher_id', Auth::id())->with('course')->get();
        return new ExamCollection($exams);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('components.examForm')
            ->with('role', 'teacher');
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
            ->with('role', 'teacher')
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
