<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class FinanceDashboard extends Controller
{

    /**
     * Show the finance dashboard.
     *
     * @return Renderable
     */
    public function finance(): Renderable
    {
        return view('finance.finance');
    }

    /**
     * Show the finance dashboard.
     *
     * @return Renderable
     */
    public function profile(): Renderable
    {
        return view('finance.profile', ['id' => Auth::id()]);
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
