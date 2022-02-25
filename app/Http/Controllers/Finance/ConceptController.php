<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConceptAddRequest;
use App\Http\Requests\ConceptRequest;
use App\Http\Requests\ConceptUpdateRequest;
use App\Http\Resources\ConceptCollection;
use App\Http\Resources\ConceptResource;
use App\Models\Bill;
use App\Models\Concept;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ConceptController extends Controller
{

    /**
     * List of concepts
     *
     * @return ConceptCollection
     */
    public function list(): ConceptCollection
    {
        return new ConceptCollection(Concept::all());
    }

    /**
     * Store of concepts
     *
     * @param ConceptRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(ConceptRequest $request, User $user): JsonResponse
    {
        $payment = $request->validated();
        $concept = Concept::find($payment['concept_id']);
        $bill = [
            'description' => $concept->name,
            'price' => $concept->total,
            'total' => $concept->total,
        ];
        $user->bills()->save(new Bill($bill));
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }
}
