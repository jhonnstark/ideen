<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseCollection;
use App\Models\Activity;
use App\Models\Course;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('profile', ['id' => Auth::id()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \App\Http\Resources\User
     */
    public function info()
    {
        return new UserResource(Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return CourseCollection|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courses()
    {
        return view('courses', ['id' => Auth::id()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return CourseCollection
     */
    public function list()
    {
        $user = Auth::user();
        $user->load('courses.teacher');
        $courses = $user->courses;
        return new CourseCollection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @return ActivityResource
     */
    public function activity(Course $course)
    {
        $course->load('activity');
        return new ActivityResource($course->activity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     * @return ContentResource
     */
    public function content(Course $course)
    {
        $course->load('content');
        return new ContentResource($course->content);
    }
}
