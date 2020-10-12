<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $type
     * @return array
     */
    public function store(Request $request, $type) {
        $course = Course::find($request->input('course_id'));
        $name = $course->id . '_' . $type . '_' . $request->material->getClientOriginalName();

        return [
            'size' => $request->material->getSize(),
            'url' => Storage::disk('s3')->putFileAs('material', $request->material, $name),
            'ext' => $request->material->getClientOriginalExtension(),
            'name' => $name
        ];
    }
}
