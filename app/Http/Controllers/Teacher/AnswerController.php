<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Http\Resources\AnswerCollection;
use App\Models\Answer;
use App\Models\Question;
use Exception;
use Illuminate\Http\JsonResponse;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Question $question
     *
     * @return AnswerCollection
     */
    public function index(Question $question): AnswerCollection
    {
        return new AnswerCollection($question->answers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AnswerRequest $request
     *
     * @return JsonResponse
     */
    public function store(AnswerRequest $request): JsonResponse
    {
        $answer = Answer::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
            'data' => $answer
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AnswerRequest $request
     * @param Answer $answer
     *
     * @return JsonResponse
     */
    public function update(AnswerRequest $request, Answer $answer): JsonResponse
    {
        $answer->update($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'edited',
            'data' => $answer
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Answer $answer): JsonResponse
    {
        $answer->delete();
        return response()->json([
            'status' => 201,
            'message' => 'deleted',
        ], 201);
    }
}
