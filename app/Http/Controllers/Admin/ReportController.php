<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

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
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function store(ReportRequest $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        return Excel::download(new UsersExport, 'users.xlsx');
        return response()->json([
            'message' => 'generated report',
            'data' => [
                'link' => ''
            ]
        ]);
    }
}
