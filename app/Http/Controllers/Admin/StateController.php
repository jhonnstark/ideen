<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StateCollection;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * List of states
     *
     * @return StateCollection
     */
    public function list(): StateCollection
    {
        return new StateCollection(State::all());
    }
}
