<?php

namespace App\Http\Controllers\Finance;

use App\Exports\UserGeneralExport;
use App\Exports\UsersByDateExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\JsonResponse;
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
        $url = '';

        if ($param['type'] === 'Por alumno') {
            Excel::store(new UsersExport($param['user_id']), $name, 's3');
            $url = Storage::disk('s3')->temporaryUrl($name, now()->addMinutes(5));
        } elseif ($param['type'] === 'Por fecha') {
            if ($param['ordered'] === 'Por alumno') {
                Excel::store(new UsersByDateExport($param['user_id'], $param['range']), $name, 's3');
            } else {
                Excel::store(new UserGeneralExport($param['range']), $name, 's3');
            }
            $url = Storage::disk('s3')->temporaryUrl($name, now()->addMinutes(5));
        }

        return response()->json([
            'message' => 'generated report',
            'meta' => [
                'link' => $url,
                'name' => $name,
            ]
        ]);
    }
}
