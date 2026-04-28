<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        $logs = ActivityLog::with('user')->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))->when($request->action, fn($q) => $q->where('action', $request->action))->latest()->paginate(5)->withQueryString();

        return view('logs.index', compact('logs', 'users'));
    }
}
