<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CycleRequest;
use App\Http\Resources\CycleCollection;
use App\Http\Resources\CycleResource;
use App\Models\Cycle;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CycleController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'cycle', 'type' => 'personnel'];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.list', $this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return CycleCollection
     */
    public function list(): CycleCollection
    {
        return new CycleCollection(Cycle::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.register', $this->role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CycleRequest $request
     * @return JsonResponse
     */
    public function store(CycleRequest $request): JsonResponse
    {
        Cycle::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Cycle $cycle
     * @return CycleResource
     */
    public function show(Cycle $cycle): CycleResource
    {
        return new CycleResource($cycle);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Cycle $cycle
     * @return Application|Factory|View
     */
    public function edit(Cycle $cycle)
    {
        $this->role['id'] = $cycle->id;
        return view('admin.edit', $this->role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CycleRequest $request
     * @param Cycle $cycle
     * @return JsonResponse
     */
    public function update(CycleRequest $request, Cycle $cycle): JsonResponse
    {
        $cycle->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update cycle'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cycle $cycle
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Cycle $cycle): JsonResponse
    {
        $cycle->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Level'
        ],204 );
    }
}
