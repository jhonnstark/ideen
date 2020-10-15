<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\Teacher;
use App\Models\Activity;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherDashboard extends Controller
{
    /**
     * MaterialController instance.
     */
    private $materialController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->materialController = new MaterialController();
    }

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
     * @param Course $course
     * @return ActivityResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseInfo(Course $course)
    {
        return view('components.courseInfo', [
            'role' => 'teacher',
            'id' => $course->id,
            'img' => $course->url_big,
            'name' => $course->name
        ]);
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
     * @param Activity $activity
     * @return MaterialResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activityDetail(Activity $activity)
    {
        $activities = $activity->load('course.activity')->course->activity;
        return view('detail', [
            'id' => $activity,
            'role' => 'teacher',
            'type' => 'activity',
            'contents' => $activities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Content $content
     * @return MaterialResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contentDetail(Content $content)
    {
        $contents = $content->load('course.content')->course->content;
        return view('detail', [
            'id' => $content,
            'role' => 'teacher',
            'type' => 'content',
            'contents' => $contents
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Activity $activity
     * @return MaterialResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activityJson(Activity $activity)
    {
        $material = $activity->load('material')->material->first();
        $url = Storage::disk('s3')->temporaryUrl(
            $material->url, now()->addMinutes(5)
        );
        $material->url = $url;
        return new MaterialResource($material);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Content $content
     * @return MaterialResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contentJson(Content $content)
    {
        $material = $content->load('material')->material->first();
        $url = Storage::disk('s3')->temporaryUrl(
            $material->url, now()->addMinutes(5)
        );
        $material->url = $url;
        return new MaterialResource($material);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function createActivity(Course $course)
    {
        return view('activityAdd')
            ->with('role', 'activity')
            ->with('course', $course->id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityRequest $request
     * @return JsonResponse
     */
    public function storeActivity(ActivityRequest $request)
    {
        $validated = $request->validated();
        $validated['active'] = $validated['active'] === 'true';
        $activity = Activity::create($validated);
        $activity->material()->create($this->materialController->store($request, 'activity'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }
}
