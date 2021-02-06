<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinishScoreRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ScoreResource;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Module;
use App\Models\Score;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
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
}
