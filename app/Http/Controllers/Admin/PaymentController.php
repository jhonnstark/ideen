<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\UserCollection;
use App\Models\Payment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
//    public function associate(Request $request, User $user): JsonResponse
//    {
//        $validatedData = $request->validate([
//            'course_id' => ['required'],
//        ]);
//        $user->courses()->syncWithoutDetaching($validatedData['course_id']);
//        return response()->json([
//            'status' => 201,
//            'message' => 'created',
//        ], 201);
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
//    public function detach(Request $request, User $user): JsonResponse
//    {
////        $user->courses()->detach($request->input('id'));
//        return response()->json([
//            'status' => 200,
//            'message' => 'Updated user'
//        ]);
//    }

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
//        $user->delete();
        return response()->json([
            'status' => 204,
            'message' => 'Deleted user'
        ],204 );
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
