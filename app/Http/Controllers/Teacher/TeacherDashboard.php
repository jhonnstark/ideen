<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherDashboard extends Controller
{

    /**
     * Show the teacher dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function teacher()
    {
        return view('teacher.teacher');
    }

    /**
     * Show the teacher dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('teacher.teacher');
    }

    /**
     * Show the teacher dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function courses()
    {
        return view('teacher.teacher');
    }
}
