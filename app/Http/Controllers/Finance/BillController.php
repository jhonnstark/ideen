<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Http\Resources\BillCollection;
use App\Models\Bill;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BillController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'bills', 'type' => 'finance'];

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
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $role = $this->role['role'];
        $id = $user->id;
        $user->load('payments');
        $type = $this->role['type'];
        return view('admin.billsList', compact('role', 'id', 'user', 'type'));
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
     * @param BillRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(BillRequest $request, User $user): JsonResponse
    {
        $payment = $request->validated();
        $user->bills()->save(new Bill($payment));
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Bill $bill
     * @return JsonResponse
     */
    public function update(Bill $bill): JsonResponse
    {
        $bill->paid_at = now();
        $userId = $bill->user_id;
        $name = $bill->id . '_' . $userId . '_' . $this->role['role'] . '_bill';
        $bill->load('user');
        $bill['url'] = 'recibos/'. $name .'.pdf';
        $bill['name'] = $name;
        $recipe = $bill->toArray();
        $recipe['date'] = now()->locale('es')->isoFormat('LL');

        $content = PDF::loadView('bill', $recipe)->output();
        Storage::disk('s3')->put($bill['url'], $content);
        $bill->save();

        return response()->json([
            'data' => $bill,
            'status' => 200,
            'message' => 'Updated user'
        ]);
    }

    /**
     * Show a new certificate
     *
     * @param Bill $bill
     * @return Application|Factory|View
     */
    public function certificateView(Bill $bill)
    {
        $date = now()->locale('es')->isoFormat('LL');
        $bill->load('user');
        return view('bill', $bill)->with('date', $date);
    }

    /**
     * Downloads the generated pdf
     *
     * @param Bill $bill
     * @return StreamedResponse
     */
    public function getPaidBill(Bill $bill): StreamedResponse
    {
        return Storage::disk('s3')->download($bill->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bill $bill
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Bill $bill): JsonResponse
    {
        if ($bill->paid_at === null) {
            $bill->delete();
        }
        return response()->json([
            'status' => 204,
            'message' => 'Deleted bill'
        ],204 );
    }
}
