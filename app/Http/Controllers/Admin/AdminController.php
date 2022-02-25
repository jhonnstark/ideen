<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Resources\AdminCollection;
use App\Models\Admin;
use App\Http\Resources\Admin as AdminResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'admins'];

    /**
     * Display a listing view of the resource.
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
     * @return AdminCollection
     */
    public function list(): AdminCollection
    {
        return new AdminCollection(Admin::all());
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
     * @param AdminRequest $request
     * @return JsonResponse
     */
    public function store(AdminRequest $request): JsonResponse
    {
        $record = $request->validated();
        $record['password'] = Hash::make($record['password']);
        Admin::create($record);
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Admin $admin
     * @return AdminResource|Application|Factory|View
     */
    public function show(Request $request, Admin $admin)
    {
        if ($request->wantsJson()) {
            return new AdminResource($admin);
        }
        $role = $this->role['role'];
        $id = $admin->id;
        return view('admin.edit', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUpdateRequest $request
     * @param Admin $admin
     * @return JsonResponse
     */
    public function update(AdminUpdateRequest $request, Admin $admin): JsonResponse
    {
        $admin->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update admin'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin): JsonResponse
    {
        $admin->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted admin'
        ],204 );
    }
}
