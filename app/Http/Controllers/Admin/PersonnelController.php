<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\PersonnelUpdateRequest;
use App\Http\Resources\PersonnelCollection;
use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PersonnelController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'admins'];

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
     * @return PersonnelCollection
     */
    public function list(): PersonnelCollection
    {
        return new PersonnelCollection(Personnel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.register', $this->role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PersonnelRequest $request
     * @return JsonResponse
     */
    public function store(PersonnelRequest $request): JsonResponse
    {
        $record = $request->validated();
        $record['password'] = Hash::make($record['password']);
        Personnel::create($record);
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Personnel $personnel
     * @return PersonnelResource|Application|Factory|View
     */
    public function show(Request $request, Personnel $personnel)
    {
        if ($request->wantsJson()) {
            return new PersonnelResource($personnel);
        }
        $role = $this->role['role'];
        $id = $personnel->id;
        return view('admin.edit', compact('role', 'id'));
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param Personnel $personnel
//     * @return Response
//     */
//    public function edit(Personnel $personnel)
//    {
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonnelUpdateRequest $request
     * @param Personnel $personnel
     * @return JsonResponse
     */
    public function update(PersonnelUpdateRequest $request, Personnel $personnel): JsonResponse
    {
        $personnel->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update admin'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Personnel $personnel
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Personnel $personnel): JsonResponse
    {
        $personnel->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted admin'
        ],204 );
    }
}
