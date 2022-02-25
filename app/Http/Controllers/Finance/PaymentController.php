<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\View\View;

class PaymentController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'payment', 'type' => 'finance'];


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
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return response()->json([
            'data' => User::with('payments')->get(),
            'status' => 200,
            'message' => 'Users listed',
        ]);
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
        $type = $this->role['type'];
        return view('admin.register', compact('role', 'id', 'name', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(PaymentRequest $request, User $user): JsonResponse
    {
        $payment = $request->validated();
        $payment['total'] = $payment['price'] * (1 - $payment['scholarship'] / 100);
        $user->payments()->save(new Payment($payment));
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function suspend(User $user): JsonResponse
    {
        $user->toggleSuspend();
        return response()->json([
            'status' => 204,
            'message' => 'Updated user',
            'data' => $user->deactivated_at
        ],200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Payment $payment
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Payment $payment): JsonResponse
    {
        $payment->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted payment'
        ],204 );
    }
}
