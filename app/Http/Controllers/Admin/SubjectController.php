<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'subject'];

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
     * @param Request $request
     * @return SubjectCollection
     */
    public function list(Request $request): SubjectCollection
    {
        $program = $request->query('program');
        if ($program) {
            return new SubjectCollection(Subject::where('program_id', $program)->get());
        }
        return new SubjectCollection(Subject::all());
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
     * @param SubjectRequest $request
     * @return JsonResponse
     */
    public function store(SubjectRequest $request): JsonResponse
    {
        Subject::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @return SubjectResource
     */
    public function show(Subject $subject): SubjectResource
    {
        return new SubjectResource($subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subject $subject
     * @return Application|Factory|View
     */
    public function edit(Subject $subject)
    {
        $this->role['id'] = $subject->id;
        return view('admin.edit', $this->role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubjectRequest $request
     * @param Subject $subject
     * @return JsonResponse
     */
    public function update(SubjectRequest $request, Subject $subject): JsonResponse
    {
        $subject->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update cycle'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Level'
        ],204 );
    }
}
