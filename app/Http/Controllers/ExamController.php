<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveClaimRequest;
use App\Http\Resources\ClaimCollection;
use App\Http\Resources\ClaimResource;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamUserResource;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExamController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
     * @param Exam $exam
     *
     * @return View
     */
    public function solveExam(Exam $exam): View
    {
        return view('solveExam', ['id' => $exam->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Exam $exam
     *
     * @return ExamUserResource
     */
    public function startExam(Exam $exam): ExamUserResource
    {
        $exam->load('questions.answers');
        $exam->scores()->firstOrCreate([
           'user_id' => Auth::id()
        ]);
        return new ExamUserResource($exam);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param SaveClaimRequest $request
     *
     * @return JsonResponse
     */
    public function saveClaim(Question $question, SaveClaimRequest $request): JsonResponse
    {
        $profess = is_int($request->claim)
            ? Answer::find($request->claim)->option
            : $request->claim;
        $claim = $question->claims()->updateOrCreate(
            [
                'user_id' => Auth::id(),
            ],
            [
                'profess' => $profess
            ]);
        return response()->json([
            'status' => 201,
            'message' => 'saved',
            'data' => $claim
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     *
     * @return ClaimResource
     */
    public function loadClaim(Question $question): ClaimResource
    {
        $question->load('claims');
        return new ClaimResource($question->claims->first());
    }
}
