<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Http\Resources\LevelCollection;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LevelController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'level'];


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.list', $this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return LevelCollection
     */
    public function list(): LevelCollection
    {
        return new LevelCollection(Level::all());
    }

    /**
     * Display a register form of the resource.
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
     * @param LevelRequest $request
     * @return JsonResponse
     */
    public function store(LevelRequest $request): JsonResponse
    {
        Level::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Level $level
     * @return LevelResource|Application|Factory|View
     */
    public function show(Request $request, Level $level)
    {
        if ($request->wantsJson()) {
            return new LevelResource($level);
        }
        $role = $this->role['role'];
        $id = $level->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LevelRequest $request
     * @param Level $level
     * @return JsonResponse
     */
    public function update(LevelRequest $request, Level $level): JsonResponse
    {
        $level->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update level'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Level $level
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Level $level): JsonResponse
    {
        $level->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Course'
        ],204 );
    }
}
