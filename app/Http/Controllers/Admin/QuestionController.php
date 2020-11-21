<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionCollection;
use App\Models\Exam;
use App\Models\Question;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Exam $exam
     * @return QuestionCollection
     */
    public function index(Exam $exam): QuestionCollection
    {
        return new QuestionCollection($exam->questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return JsonResponse
     */
    public function store(QuestionRequest $request): JsonResponse
    {
        $question = Question::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
            'data' => $question
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Question $question
     * @return void
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Question $question): JsonResponse
    {
        $question->delete();
        return response()->json([
            'status' => 201,
            'message' => 'deleted',
        ], 201);
    }
}
