<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param ReportRequest $request
     * @return JsonResponse
     */
    public function store(ReportRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'generated report',
            'data' => [
                'link' => ''
            ]
        ]);
    }
}
