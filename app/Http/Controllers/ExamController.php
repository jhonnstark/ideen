<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveClaimRequest;
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
        $question->claims()->updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [
                'profess' => Answer::find($request->claim)->option
            ]);
        return response()->json([
            'status' => 201,
            'message' => 'saved',
        ], 201);
    }
}
