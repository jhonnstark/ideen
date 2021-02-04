<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Http\Resources\ContentResource;
use App\Http\Resources\ModulesResource;
use App\Models\Course;
use App\Models\Module;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'course'];

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
     * Show the form for creating a new resource.
     *
     * @param Course $course
     *
     * @return Application|Factory|View
     */
    public function create(Course $course)
    {
        return view('admin.register')
            ->with('role', 'module')
            ->with('course', $course->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModuleRequest $request
     *
     * @return JsonResponse
     */
    public function store(ModuleRequest $request): JsonResponse
    {
        Module::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return ModulesResource
     */
    public function show(Course $course): ModulesResource
    {
        $course->load('module');
        return new ModulesResource($course->module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     *
     * @return Application|Factory|View
     */
    public function edit(Module $module)
    {
        return view('admin.edit', ['role' => 'module', 'id' => $module->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     *
     * @return ModulesResource
     */
    public function moduleJson(Module $module): ModulesResource
    {
        return new ModulesResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModuleRequest $request
     * @param Module $module
     *
     * @return JsonResponse
     */
    public function update(ModuleRequest $request, Module $module): JsonResponse
    {
        $module->update($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'updated',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Module $module): JsonResponse
    {
        $module->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted activity'
        ],204 );
    }
}
