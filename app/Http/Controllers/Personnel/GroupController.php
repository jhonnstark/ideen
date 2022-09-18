<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Http\Resources\UserCollection;
use App\Models\Group;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'group', 'type' => 'personnel'];

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
     * @return GroupCollection
     */
    public function list(): GroupCollection
    {
        return new GroupCollection(Group::all());
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
     * @param GroupRequest $request
     * @return JsonResponse
     */
    public function store(GroupRequest $request): JsonResponse
    {
        Group::create($request->validated());
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return GroupResource
     */
    public function show(Group $group): GroupResource
    {
        return new GroupResource($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Application|Factory|View
     */
    public function edit(Group $group)
    {
        $this->role['id'] = $group->id;
        return view('admin.edit', $this->role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest $request
     * @param Group $group
     * @return JsonResponse
     */
    public function update(GroupRequest $request, Group $group): JsonResponse
    {
        $group->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update cycle'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Group $group): JsonResponse
    {
        $group->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted Level'
        ],204 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return JsonResponse
     */
    public function associate(Request $request, Group $group): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
        ]);
        $group->users()->syncWithoutDetaching($validatedData['user_id']);
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Loads the students of a course.
     *
     * @param Group $group
     * @return UserCollection
     */
    public function students(Group $group): UserCollection
    {
        $group->load('users');
        return new UserCollection($group->users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return JsonResponse
     */
    public function detach(Request $request, Group $group): JsonResponse
    {
        $group->users()->detach($request->input('id'));
        return response()->json([
            'status' => 200,
            'message' => 'Updated user'
        ]);
    }
}
