<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Str;

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
        $param = $request->validated();
        $name = 'reports/' . $param['type'] . '_' . Str::random(10) . '.xlsx';
        Excel::store(new UsersExport(), $name, 's3');
        $url = Storage::disk('s3')->temporaryUrl($name, now()->addMinutes(5));
        return response()->json([
            'message' => 'generated report',
            'meta' => [
                'link' => $url
            ]
        ]);
    }
}
