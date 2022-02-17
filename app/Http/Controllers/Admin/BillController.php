<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Http\Resources\BillCollection;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BillController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'payment'];

    /**
     * return payments list for a user.
     *
     * @param User $user
     * @return BillCollection
     */
    public function index(User $user): BillCollection
    {
        $user->load('bills');
        return new BillCollection($user->bills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return View
     */
    public function create(User $user): View
    {
        $role = $this->role['role'];
        $id = $user->id;
        $name = $user->name . ' ' . $user->lastname . ' ' . $user->mothers_lastname;
        return view('admin.register', compact('role', 'id', 'name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BillRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(BillRequest $request, User $user): JsonResponse
    {
        $payment = $request->validated();
        $payment['total'] = $payment['price'] * (1 - $payment['discount'] / 100);
        $user->bills()->save(new Bill($payment));
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }
}
