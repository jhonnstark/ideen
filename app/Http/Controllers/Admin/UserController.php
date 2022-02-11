<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\UserCollection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'user'];


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
     * @return UserCollection
     */
    public function list(): UserCollection
    {
        return new UserCollection(User::all());
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
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function associate(Request $request, User $user): JsonResponse
    {
        $validatedData = $request->validate([
            'course_id' => ['required'],
        ]);
        $user->courses()->syncWithoutDetaching($validatedData['course_id']);
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param User $user
     * @return CourseCollection
     */
    public function courses(User $user): CourseCollection
    {
        $user->load('courses.teacher');
        $courses = $user->courses;
        return new CourseCollection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $record = $request->validated();
        $record['password'] = Hash::make($record['password']);
        User::create($record);
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return UserResource|Application|Factory|View
     */
    public function show(Request $request, User $user)
    {
        if ($request->wantsJson()) {
            return new UserResource($user);
        }
        $role = $this->role['role'];
        $id = $user->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Updated user'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function detach(Request $request, User $user): JsonResponse
    {
        $user->courses()->detach($request->input('id'));
        return response()->json([
            'status' => 200,
            'message' => 'Updated user'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted user'
        ],204 );
    }
}
