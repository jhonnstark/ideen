<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

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
}
