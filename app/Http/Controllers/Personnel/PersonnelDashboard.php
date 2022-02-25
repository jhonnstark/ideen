<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class PersonnelDashboard extends Controller
{

    /**
     * Show the teacher dashboard.
     *
     * @return Renderable
     */
    public function personnel(): Renderable
    {
        return view('personnel.personnel');
    }

    /**
     * Show the personnel dashboard.
     *
     * @return Renderable
     */
    public function profile(): Renderable
    {
        return view('personnel.profile', ['id' => Auth::id()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return PersonnelResource
     */
    public function info(): PersonnelResource
    {
        return new PersonnelResource(Auth::user());
    }
}
