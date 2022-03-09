<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinanceRequest;
use App\Http\Requests\FinanceUpdateRequest;
use App\Http\Resources\FinanceCollection;
use App\Http\Resources\FinanceResource;
use App\Models\Finance;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FinanceController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'finances'];

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
     * @return FinanceCollection
     */
    public function list(): FinanceCollection
    {
        return new FinanceCollection(Finance::all());
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
     * @param FinanceRequest $request
     * @return JsonResponse
     */
    public function store(FinanceRequest $request): JsonResponse
    {
        $record = $request->validated();
        $record['password'] = Hash::make($record['password']);
        Finance::create($record);
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Finance $finance
     * @return FinanceResource|Application|Factory|View
     */
    public function show(Request $request, Finance $finance)
    {
        if ($request->wantsJson()) {
            return new FinanceResource($finance);
        }
        $role = $this->role['role'];
        $id = $finance->id;
        return view('admin.edit', compact('role', 'id'));
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param Finance $finance
//     * @return Response
//     */
//    public function edit(Finance $finance)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param FinanceUpdateRequest $request
     * @param Finance $finance
     * @return JsonResponse
     */
    public function update(FinanceUpdateRequest $request, Finance $finance): JsonResponse
    {
        $finance->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Update admin'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Finance $finance
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Finance $finance): JsonResponse
    {
        $finance->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted admin'
        ],204 );
    }
}
