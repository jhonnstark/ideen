<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Http\Resources\ContentResource;
use App\Http\Resources\MaterialResource;
use App\Models\Content;
use App\Models\Module;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContentController extends Controller
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
            ->with('role', 'content')
            ->with('course', $module->course_id)
            ->with('module', $module->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function store(ContentRequest $request)
    {
        $validated = $request->validated();
        $content = Content::create($validated);
        $content->material()->create($this->materialController->store($request, 'content'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Module $module
     * @return ContentResource
     */
    public function show(Module $module)
    {
        $module->load('content');
        return new ContentResource($module->content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Content $content
     * @return ContentResource|Application|Factory|View
     */
    public function edit(Request $request, Content $content)
    {
        if ($request->wantsJson()) {
            return new ContentResource($content);
        }
        return view('admin.edit', ['role' => 'content', 'id' => $content->module_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Content $content
     * @return MaterialResource
     */
    public function getMaterial(Content $content)
    {
        $material = $content->load('material')->material->first();
        $url = Storage::disk('s3')->temporaryUrl(
            $material->url, now()->addMinutes(5)
        );
        $material->url = $url;
        return new MaterialResource($material);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContentRequest $request
     * @param Content $content
     * @return JsonResponse
     */
    public function update(ContentRequest $request, Content $content)
    {
        $content->update($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'updated',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Content $content
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted activity'
        ],204 );
    }
}
