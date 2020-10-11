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
    private $materialController;

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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
