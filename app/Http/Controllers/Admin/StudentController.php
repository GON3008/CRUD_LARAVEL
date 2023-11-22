<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    const PATH_VIEW = 'admin.students.';
    const PATH_UPLOAD = 'students';

    public function index()
    {
        $data = Student::query()->latest()->paginate(5);

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
            'code' => ['required', 'max:10', 'unique:students,code'],
            'date_of_birth' => ['date', 'nullable'],
            'img' => ['image', 'max:255', 'nullable'],
            'is_active' => [
                'required',
                Rule::in([
                    Student::Active,
                    Student::IsActive,
                ]),
            ],
        ]);

        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        }

        Student::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    public function show(Student $student)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('student'));
    }

    public function edit(Student $student)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        request()->validate([
            'name' => ['required', 'max:100', Rule::unique('students')->ignore($student->id)],
            'code' => ['required', 'max:10', 'unique:students,code'],
            'date_of_birth' => ['date', 'nullable'],
            'img' => ['image', 'max:255', 'nullable', 'required_if:img,null'],
            'is_active' => [
                'required',
                Rule::in([
                    Student::Active,
                    Student::IsActive,
                ]),
            ],
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));

            $oldPathImg = $student->img;

            $student->update($data);

            if (Storage::exists($oldPathImg)) {
                Storage::delete($oldPathImg);
            }
        } else {
            $student->update($data);
        }

        return back()->with('msg', 'Thao tác thành công');
    }



    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            if (!empty($student->img) && Storage::exists($student->img)) {
                Storage::delete($student->img);
            }

            $student->delete();

            return back()->with('msg', 'Thao tác thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }




    public function deleteMany()
    {

    }
}