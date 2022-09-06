<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Response;
use Request;

class SubjectController extends Controller
{

    /**
     * Display a listing view of the resource.
     */
    private $role = ['role' => 'subject'];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.list', $this->role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.register', $this->role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @return Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subject $subject
     * @return Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param Subject $subject
     * @return Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @return Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
