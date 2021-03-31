<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\MaterialResource;
use App\Models\Activity;
use App\Models\Module;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * MaterialController instance.
     */
    private $materialController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->materialController = new MaterialController();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Module $module
     * @return Application|Factory|Response|View
     */
    public function create(Module $module)
    {
        return view('admin.register')
            ->with('role', 'activity')
            ->with('course', $module->course_id)
            ->with('module', $module->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityRequest $request
     * @return JsonResponse
     */
    public function store(ActivityRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $activity = Activity::create($validated);
        $activity->material()->create($this->materialController->store($request, 'activity'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Module $module
     * @return ActivityResource
     */
    public function show(Module $module): ActivityResource
    {
        $module->load('activity');
        return new ActivityResource($module->activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Activity $activity
     *
     * @return Application|Factory|View
     */
    public function edit(Activity $activity)
    {
        return view('admin.edit', [
            'role' => 'activity',
            'id' => $activity->module_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Activity $activity
     *
     * @return ActivityResource
     */
    public function getJson(Activity $activity): ActivityResource
    {
        return new ActivityResource($activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Activity $activity
     * @return MaterialResource
     */
    public function getMaterial(Activity $activity): MaterialResource
    {
        $material = $activity->load('material')->material->first();
        $url = Storage::disk('s3')->temporaryUrl(
            $material->url, now()->addMinutes(5)
        );
        $material->url = $url;
        return new MaterialResource($material);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return JsonResponse
     */
    public function update(ActivityRequest $request, Activity $activity): JsonResponse
    {
        $activity->update($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'updated',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Activity $activity
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Activity $activity): JsonResponse
    {
        $activity->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted activity'
        ],204 );
    }
}
