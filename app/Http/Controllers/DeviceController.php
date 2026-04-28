<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:devices.view')->only(['index', 'show']);
        $this->middleware('permission:devices.create')->only(['create', 'store']);
        $this->middleware('permission:devices.edit')->only(['edit', 'update']);
        $this->middleware('permission:devices.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $query = Device::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $devices = $query->orderBy('created_at', 'asc')->paginate(5);

        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:devices,code',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')->with('success', 'Device created');
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:devices,code,' . $device->id,
            'status' => 'required',
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')->with('success', 'Device updated');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return back()->with('success', 'Deleted');
    }
}
