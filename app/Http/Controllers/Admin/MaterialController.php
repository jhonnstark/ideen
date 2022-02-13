<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $type
     *
     * @return array
     */
    public function store(Request $request, $type): array
    {
        $id = $request->input('module_id') ?? $request->input('activity_id');
        $name = $id . '_' . $type . '_' . $request->material->getClientOriginalName();

        return [
            'size' => $request->material->getSize(),
            'url' => Storage::disk('s3')->putFileAs('material', $request->material, $name),
            'ext' => $request->material->getClientOriginalExtension(),
            'name' => $name
        ];
    }

    /**
     * Store a newly created certificate in storage.
     *
     * @param string $role
     * @param array $model
     * @return array
     */
    public function storeCertificate(string $role, array $model): array
    {
        $name = $model['id'] . '_' . $role . '_constancia';
        $url = 'certificados/' . $role . '/' . $name .'.pdf';
        $content = PDF::loadView('work_proof', $model)->output();
        Storage::disk('s3')->put($url, $content);

        return [
            'size' => 0,
            'url' => $url,
            'ext' => 'pdf',
            'name' => $name
        ];
    }
}
