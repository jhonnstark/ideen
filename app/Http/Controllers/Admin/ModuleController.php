<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Http\Resources\ContentResource;
use App\Http\Resources\ModulesResource;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'course'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.list', $this->role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Course $course)
    {
        return view('admin.register')
            ->with('role', 'content')
            ->with('course', $course->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModuleRequest $request
     * @return JsonResponse
     */
    public function store(ModuleRequest $request)
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
     * @return ContentResource
     */
    public function show(Course $course)
    {
        $course->load('module');
        return new ContentResource($course->content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Module $module
     * @return ModulesResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Module $module)
    {
        if ($request->wantsJson()) {
            return new ModulesResource($module);
        }
        return view('admin.edit', ['role' => 'module', 'id' => $module->course_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Module  $module
     * @return JsonResponse
     */
    public function update(Request $request, Module $module)
    {
        //todo: make updates
        return response()->json([
            'status' => 201,
            'message' => 'updated',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted activity'
        ],204 );
    }
}
