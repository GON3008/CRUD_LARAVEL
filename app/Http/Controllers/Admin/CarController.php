<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    const PATH_VIEW = 'admin.cars.';
    const PATH_UPLOAD = 'cars';

    public function index()
    {
        $data = Car::query()->with('category')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $categories = Category::query()
            ->latest()
            ->pluck('name', 'id')
            ->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'unique:cars', 'max:100'],
            'brand' => ['required', 'max:100'],
            'img' => ['image', 'max:255', 'nullable'],
            'description' => ['nullable', 'max:500'],
            'is_active' => [
                'required',
                Rule::in([
                    Car::Active,
                    Car::IsActive,
                ]),
            ],
        ]);


        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        }

        Car::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    public function show(Car $car)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('car'));
    }

    public function edit(Car $car)
    {
        $categories = Category::query()
            ->latest()
            ->pluck('name', 'id')
            ->where('is_active', 1)
            ->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('car', 'categories'));
    }

    public function update(Request $request, Car $car)
    {
        request()->validate([
            'name' => ['required', 'max:100', Rule::unique('cars')->ignore($car->id)],
            'brand' => ['required', 'max:100'],
            'img' => ['image', 'max:255', 'nullable', 'required_if:img,null'],
            'description' => ['nullable', 'max:500'],
            'is_active' => [
                'required',
                Rule::in([
                    Car::Active,
                    Car::IsActive,
                ]),
            ],
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));

            $oldPathImg = $car->img;

            $car->update($data);

            if (Storage::exists($oldPathImg)) {
                Storage::delete($oldPathImg);
            }
        } else {
            $car->update($data);
        }

        return back()->with('msg', 'Thao tác thành công');
    }



    public function destroy($id)
    {
        try {
            $car = Car::findOrFail($id);
            if (!empty($car->img) && Storage::exists($car->img)) {
                Storage::delete($car->img);
            }

            $car->delete();

            return back()->with('msg', 'Thao tác thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }




    public function deleteMany()
    {
        //
    }
}