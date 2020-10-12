<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\MaterialCollection;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\Teacher;
use App\Models\Activity;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        return view('teacher.profile', ['id' => Auth::id()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Teacher
     */
    public function info()
    {
        return new Teacher(Auth::user());
    }

    /**
     * Show the teacher dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function courses()
    {
        return view('teacher.courses', ['id' => Auth::id()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return CourseCollection
     */
    public function list()
    {
        $user = Auth::user();
        $user->load('courses');
        $courses = $user->courses->loadCount('student');
        return new CourseCollection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ActivityResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseInfo($id)
    {
        return view('components.courseInfo', ['role' => 'teacher', 'id' => $id]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Activity $activity
     * @return MaterialResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activityDetail(Request $request, Activity $activity)
    {
        if ($request->wantsJson()) {
            $material = $activity->load('material')->material->first();
            $url = Storage::disk('s3')->temporaryUrl(
                $material->url, now()->addMinutes(5)
            );
            $material->url = $url;
            return new MaterialResource($material);
        }
        return view('detail', ['id' => $activity,'type' => 'activity']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Content $content
     * @return MaterialResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contentDetail(Request $request, Content $content)
    {
        if ($request->wantsJson()) {
            $material = $content->load('material')->material->first();
            $url = Storage::disk('s3')->temporaryUrl(
                $material->url, now()->addMinutes(5)
            );
            $material->url = $url;
            return new MaterialResource($material);
        }
        return view('detail', ['id' => $content,'type' => 'content']);
    }
}
