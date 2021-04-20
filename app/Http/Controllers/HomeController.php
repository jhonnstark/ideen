<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MaterialController;
use App\Http\Requests\HomeworkRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\ModulesResource;
use App\Models\Activity;
use App\Models\Content;
use App\Models\Course;
use App\Http\Resources\User as UserResource;
use App\Models\Homework;
use App\Models\Module;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
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
        $this->middleware('auth');
        $this->materialController = new MaterialController();
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function profile(): Renderable
    {
        return view('profile', ['id' => Auth::id()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return UserResource
     */
    public function info(): UserResource
    {
        return new UserResource(Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|Factory|View
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
    public function list(): CourseCollection
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
     *
     * @return Application|Factory|View
     */
    public function courseInfo(Course $course)
    {
        return view('components.courseInfo', [
            'role' => '',
            'id' => $course->id,
            'img' => $course->url_big,
            'name' => $course->name
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Course $course
     *
     * @return ModulesResource
     */
    public function module(Course $course): ModulesResource
    {
        $course->load('module');
        return new ModulesResource($course->module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Module $module
     *
     * @return ActivityResource
     */
    public function activity(Module $module): ActivityResource
    {
        $module->load('activity');
        return new ActivityResource($module->activity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Module $module
     *
     * @return ContentResource
     */
    public function content(Module $module): ContentResource
    {
        $module->load('content');
        return new ContentResource($module->content);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Activity $activity
     *
     * @return Application|Factory|View
     */
    public function activityDetail(Activity $activity)
    {
        return view('detail', [
            'id' => $activity,
            'type' => 'activity'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Module $module
     *
     * @return Application|Factory|View
     */
    public function moduleDetail(Module $module)
    {
        return view('components.courseInfo', [
            'role' => '',
            'id' => $module->id,
            'module' => 'module'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Content $content
     *
     * @return Application|Factory|View
     */
    public function contentDetail(Content $content)
    {
        $contents = $content->load('module.content')->module->content;
        return view('detail', ['id' => $content,'type' => 'content', 'contents' => $contents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Activity $activity
     *
     * @return MaterialResource
     */
    public function activityJson(Activity $activity): MaterialResource
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
     * @param Content $content
     * @return MaterialResource
     */
    public function contentJson(Content $content): MaterialResource
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
     * @param Activity $activity
     * @return Application|Factory|View
     */
    public function createHomework(Activity $activity)
    {
        return view('activityAdd')
            ->with('role', 'homework')
            ->with('course', $activity->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HomeworkRequest $request
     * @return JsonResponse
     */
    public function storeHomework(HomeworkRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $homework = Homework::create($validated);
        $homework->material()->create($this->materialController->store($request, 'homework'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }
}
