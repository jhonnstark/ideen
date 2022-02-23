<?php

namespace App\Http\Controllers\Admin;

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
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'concept'];

    /**
     * Display the specified resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.list', $this->role);
    }

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
     * @return Application|Factory|View
     */
    public function create()
    {
        $role = $this->role['role'];
        return view('admin.register', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConceptAddRequest $request
     * @return JsonResponse
     */
    public function register(ConceptAddRequest $request): JsonResponse
    {
        $record = $request->validated();
        Concept::create($record);
        return response()->json([
            'status' => 201,
            'message' => 'created',
            'data' => $record
        ], 201);
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

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Concept $concept
     * @return ConceptResource|Application|Factory|View
     */
    public function show(Request $request, Concept $concept)
    {
        if ($request->wantsJson()) {
            return new ConceptResource($concept);
        }
        $role = $this->role['role'];
        $id = $concept->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConceptUpdateRequest $request
     * @param Concept $concept
     * @return JsonResponse
     */
    public function update(ConceptUpdateRequest $request, Concept $concept): JsonResponse
    {
        $concept->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update admin'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Concept $concept
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Concept $concept): JsonResponse
    {
        $concept->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted concept'
        ],204 );
    }
}
