<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = LogActivity::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('waktu', 'desc')
            ->paginate(15);

        return view('user.activity.index', compact('activities'));
    }
}

