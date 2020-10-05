<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Resources\AdminCollection;
use App\Models\Admin;
use App\Http\Resources\Admin as AdminResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'admins'];

    /**
     * Display a listing view of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.list', $this->role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AdminCollection
     */
    public function list()
    {
        return new AdminCollection(Admin::all());
    }

    /**
     * Display a register form of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.register', $this->role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdminRequest $request)
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
     * @return AdminResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted admin'
        ],204 );
    }
}
