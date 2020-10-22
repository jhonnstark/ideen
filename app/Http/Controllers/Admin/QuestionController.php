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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Exam $exam
     * @return QuestionCollection
     */
    public function list(Exam $exam)
    {
        return new QuestionCollection($exam->questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return JsonResponse
     */
    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
            'data' => $question
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return void
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return void
     */
    public function edit(Question $question)
    {
        //
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
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json([
            'status' => 201,
            'message' => 'deleted',
        ], 201);
    }
}
