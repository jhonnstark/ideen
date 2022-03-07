<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;
use App\Http\Resources\Admin;
use Hash;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Controller
{

    /**
     * Show the admin dashboard.
     *
     * @return Renderable
     */
    public function admin(): Renderable
    {
        return view('admin.admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return Renderable
     */
    public function services(): Renderable
    {
        return view('admin.services');
    }

    /**
     * Show the teacher dashboard.
     *
     * @return Renderable
     */
    public function profile(): Renderable
    {
        return view('admin.profile', ['id' => Auth::id()]);
    }

    /**
     * Update the password of the user
     *
     * @param UpdatePassword $request
     * @return JsonResponse
     */
    public function update(UpdatePassword $request): JsonResponse
    {
        $valid = $request->validated();
        $user = Auth::user();
        $user->password = Hash::make($valid['password']);
        $user->save();
        return response()->json([
            'status' => 201,
            'message' => 'User updated'
        ], 201);
    }

    /**
     * Show the application dashboard.
     *
     * @return Admin
     */
    public function info(): Admin
    {
        return new Admin(Auth::user());
    }

}
