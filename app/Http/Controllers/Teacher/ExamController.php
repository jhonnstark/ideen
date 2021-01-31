<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ScoreCollection;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Score;
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
     * @return ScoreCollection
     */
    public function getScoresJson(Score $score): ScoreCollection
    {
        $score->load('exam.questions.claims')->load('exam.questions.answers');
        return new ScoreCollection($score);
    }
}
