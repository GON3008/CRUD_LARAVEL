<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    const PATH_VIEW = 'admin.devices.';
    const PATH_UPLOAD = 'devices';

    public function index()
    {
        $data = Device::query()->latest()->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store()
    {

        request()->validate([
            'name' => ['required', 'max:100'],
            'serial' => ['required', 'unique:devices', 'max:100'],
            'model' => ['required', 'max:100'],
            'img' => ['image', 'max:255', 'nullable'],
            'description' => ['nullable', 'max:500'],
            'is_active' => [
                'required',
                Rule::in([
                    Device::Active,
                    Device::IsActive,
                ]),
            ],
        ]);


        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        }

        Device::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    public function show(Device $device)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('device'));
    }

    public function edit(Device $device)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        request()->validate([
            'name' => ['required', 'max:100', Rule::unique('devices')->ignore($device->id)],
            'serial' => ['required', 'unique:devices', 'max:100'],
            'model' => ['required', 'max:100'],
            'img' => ['image', 'max:255', 'nullable', 'required_if:img,null'],
            'description' => ['nullable', 'max:500'],
            'is_active' => [
                'required',
                Rule::in([
                    Device::Active,
                    Device::IsActive,
                ]),
            ],
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));

            $oldPathImg = $device->img;

            $device->update($data);

            if (Storage::exists($oldPathImg)) {
                Storage::delete($oldPathImg);
            }
        } else {
            $device->update($data);
        }

        return back()->with('msg', 'Thao tác thành công');
    }


    public function destroy($id)
    {
        try {
            $device = Device::findOrFail($id);
            if (!empty($device->img) && Storage::exists($device->img)) {
                Storage::delete($device->img);
            }

            $device->delete();

            return back()->with('msg', 'Thao tác thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }




    public function deleteMany()
    {

    }
}