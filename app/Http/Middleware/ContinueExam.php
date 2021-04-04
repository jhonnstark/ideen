<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContinueExam
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $exam = $request->route('exam');
        $score = $exam->scores()->firstOrCreate([
            'user_id' => Auth::id()
        ]);
        $shouldFinishAt = $score->created_at->addMinutes($exam->time);
        if ($shouldFinishAt->lessThanOrEqualTo(Carbon::now())) {
            return redirect()->route('course.module.exam.grade', $exam->id);
        }
        return $next($request);
    }
}
