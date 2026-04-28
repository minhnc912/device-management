<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalDevices' => Device::count(),
            'activeDevices' => Device::where('status', 'active')->count(),
            'inactiveDevices' => Device::where('status', 'inactive')->count(),
            'maintenanceDevices' => Device::where('status', 'maintenance')->count(),

            'totalUsers' => User::count(),

            'recentLogs' => ActivityLog::with('user')->latest()->limit(5)->get(),
        ]);
    }
}
