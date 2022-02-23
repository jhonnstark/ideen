<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConceptRequest;
use App\Http\Resources\ConceptCollection;
use App\Models\Bill;
use App\Models\Concept;
use App\Models\User;
use Illuminate\Http\JsonResponse;

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
     * List of concepts
     *
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
