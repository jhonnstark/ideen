<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
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
     * @param ActivityRequest $request
     * @return JsonResponse
     */
    public function store(ActivityRequest $request)
    {
        $validated = $request->validated();
        $validated['active'] = $validated['active'] === 'true';
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
     * @param Course $course
     * @return ContentResource
     */
    public function show(Course $course)
    {
        $course->load('content');
        return new ContentResource($course->content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Content $content
     * @return ContentResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Content $content)
    {
        if ($request->wantsJson()) {
            return new ContentResource($content);
        }
        return view('admin.edit', ['role' => 'content']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Content $content
     * @return JsonResponse
     */
    public function update(Request $request, Content $content)
    {
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
