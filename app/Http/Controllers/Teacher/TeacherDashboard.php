<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\HomeworkCollection;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\ModulesResource;
use App\Http\Resources\Teacher;
use App\Http\Resources\UserCollection;
use App\Models\Activity;
use App\Models\Content;
use App\Models\Course;
use App\Models\Homework;
use App\Models\Module;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
     * @return Renderable
     */
    public function teacher()
    {
        return view('teacher.teacher');
    }

    /**
     * Show the teacher dashboard.
     *
     * @return Renderable
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
     * @return Renderable
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
     * @return Application|Factory|View
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
     * @param Module $module
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
     * @return ContentResource
     */
    public function content(Module $module): ContentResource
    {
        $module->load('content');
        return new ContentResource($module->content);
    }

    /**
     * Loads the modules of a course.
     *
     * @param Course $course
     * @return ModulesResource
     */
    public function module(Course $course): ModulesResource
    {
        $course->load('module');
        return new ModulesResource($course->module);
    }

    /**
     * Loads the students of a course.
     *
     * @param Course $course
     * @return UserCollection
     */
    public function students(Course $course): UserCollection
    {
        $course->load('student');
        return new UserCollection($course->student);
    }

    /**
     * Loads the students of a course.
     *
     * @param Activity $activity
     * @return HomeworkCollection
     */
    public function homework(Activity $activity): HomeworkCollection
    {
        $activity->load('homework.user');
        return new HomeworkCollection($activity->homework);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Homework $homework
     * @return Application|Factory|View
     */
    public function homeworkDetail(Homework $homework)
    {
        return view('detail', [
            'id' => $homework,
            'role' => 'teacher',
            'type' => 'homework',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Activity $activity
     * @return Application|Factory|View
     */
    public function activityDetail(Activity $activity)
    {
        $activities = $activity->load('module.activity')->module->activity;
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
     * @return Application|Factory|View
     */
    public function contentDetail(Content $content)
    {
        $contents = $content->load('module.content')->module->content;
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
     * @param Module $module
     * @return Application|Factory|View
     */
    public function moduleDetail(Module $module)
    {
        return view('components.courseInfo', [
            'role' => 'teacher',
            'id' => $module->id,
            'module' => 'module'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Homework $homework
     * @return MaterialResource
     */
    public function homeworkJson(Homework $homework): MaterialResource
    {
        $material = $homework->load('material')->material->first();
        $url = Storage::disk('s3')->temporaryUrl(
            $material->url, now()->addMinutes(5)
        );
        $material->url = $url;
        return new MaterialResource($material);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Activity $activity
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
     * Store a newly created resource in storage.
     *
     * @param Module $module
     * @return MaterialResource
     */
    public function moduleJson(Module $module): MaterialResource
    {
        $material = $module->load('material')->material->first();
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
     * @return Application|Factory|View
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
    public function storeActivity(ActivityRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $activity = Activity::create($validated);
        $activity->material()->create($this->materialController->store($request, 'activity'));

        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * @param Activity $activity
     *
     * @return JsonResponse
     */
    public function score(Activity $activity): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => 'score',
            'data' => $activity->score
        ], 200);
    }

    /**
     * @param Homework $homework
     *
     * @return JsonResponse
     */
    public function homeworkScore(Homework $homework): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => 'homework score',
            'data' => $homework->score
        ], 200);
    }

    /**
     * @param Request $request
     * @param Activity $activity
     *
     * @return JsonResponse
     */
    public function scoreSave(Request $request, Activity $activity): JsonResponse
    {
        $request->validate([
            'score' => 'integer|required|between:0,100',
        ]);
        $activity->score = $request->get('score');
        $activity->save();
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }

    /**
     * @param Request $request
     * @param Activity $activity
     *
     * @return JsonResponse
     */
    public function homeworkScoreSave(Request $request, Homework $homework): JsonResponse
    {
        $request->validate([
            'score' => 'integer|required|between:0,100',
        ]);
        $homework->score = $request->get('score');
        $homework->save();
        return response()->json([
            'status' => 201,
            'message' => 'created',
        ], 201);
    }
}
