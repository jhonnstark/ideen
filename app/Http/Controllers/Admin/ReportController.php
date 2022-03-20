<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.reports');
    }
}
