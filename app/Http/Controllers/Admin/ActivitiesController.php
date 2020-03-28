<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function __construct()
    {
     //   $this->middleware('admin'); krace je i lepse nego u web.php al ajde malo i tako
    }

    public function destroy(Activity $activity)
    {
        try {
            $activity->delete();
            return redirect()->back()->with('message', 'Activity successfully removed.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errors', 'An error has ocurred while deleting activity.');
        }
    }
}
