<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContinueClaim
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $question = $request->route('question')->load('exam');
        $exam = $question->exam;
        $score = $exam->scores()->firstOrCreate([
            'user_id' => Auth::id()
        ]);
        if(!is_null($score->finish_at)){
            return redirect()->route('course.module.exam.grade', $exam->id);
        }
        $shouldFinishAt = $score->created_at->addMinutes($exam->time);
        if ($shouldFinishAt->lessThanOrEqualTo(Carbon::now())) {
            $score->finish_at = now();
            $score->save();
            return redirect()->route('course.module.exam.grade', $exam->id);
        }
        return $next($request);
    }
}
