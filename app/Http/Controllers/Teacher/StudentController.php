<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentController extends Controller
{

    /**
     * Loads the students of a course.
     *
     * @param Course $course
     * @return UserCollection
     */
    public function index(Course $course): UserCollection
    {
        $course->load('student');
        return new UserCollection($course->student);
    }

    /**
     * Loads the students of a course.
     *
     * @param Course $course
     * @param User $student
     * @return Application|Factory|View
     */
    public function student(Course $course, User $student)
    {
        $student->load(['score' => function ($query) use ($course){
            $query->whereHas('exam', function ($query) use ($course){
                $query->where('course_id', $course->id);
            });
        }])->load(['homework' => function ($query) use ($course){
            $query->whereHas('activity.module', function ($query) use ($course){
                $query->where('course_id', $course->id);
            });
        }]);
        return view('teacher.student', ['user' => $student, 'role' => 'teacher']);
    }
}
