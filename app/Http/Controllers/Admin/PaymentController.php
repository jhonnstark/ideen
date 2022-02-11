<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Payment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PaymentController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'payment'];


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
     * @param PaymentRequest $request
     * @return JsonResponse
     */
    public function store(PaymentRequest $request): JsonResponse
    {
        $payment = $request->validated();
        $payment['total'] = $payment['price'] * (1 - $payment['discount'] / 100);
        $users = User::all();
        foreach ($users as $user) {
            $user->payments()->save(new Payment($payment));
        }
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * return payments list for a user.
     *
     * @param User $user
     * @return PaymentCollection
     */
    public function payments(User $user): PaymentCollection
    {
        $user->load('payments');
        return new PaymentCollection($user->payments);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $role = $this->role['role'];
        $id = $user->id;
        return view('admin.list', compact('role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Payment $payment
     * @return JsonResponse
     */
    public function update(Payment $payment): JsonResponse
    {
        $payment->paid_at = now();
        $payment->save();

        return response()->json([
            'data' => $payment,
            'status' => 200,
            'message' => 'Updated user'
        ]);
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
