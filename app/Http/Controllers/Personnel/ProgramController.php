<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramRequest;
use App\Http\Resources\ProgramCollection;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProgramController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'program', 'type' => 'personnel'];

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
     * @return ProgramCollection
     */
    public function list(): ProgramCollection
    {
        return new ProgramCollection(Program::all());
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
     * @param ProgramRequest $request
     * @return JsonResponse
     */
    public function store(ProgramRequest $request): JsonResponse
    {
        Program::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Program $program
     * @return ProgramResource
     */
    public function show(Program $program): ProgramResource
    {
        return new ProgramResource($program);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Program $program
     * @return Application|Factory|View
     */
    public function edit(Program $program)
    {
        $this->role['id'] = $program->id;
        return view('admin.edit', $this->role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProgramRequest $request
     * @param Program $program
     * @return JsonResponse
     */
    public function update(ProgramRequest $request, Program $program): JsonResponse
    {
        $program->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update cycle'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Program $program
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Program $program): JsonResponse
    {
        $program->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Level'
        ],204 );
    }
}
