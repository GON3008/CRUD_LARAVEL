@extends('layouts.master')
@include('layouts.alaert')

@section('content')
    <div class="pagetitle">
        <h1>List Of Car</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Home</a></li>
                <li class="breadcrumb-item active">List Of Car</li>
            </ol>
        </nav>
    </div>

    {{-- @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif --}}

    <div class="container">
        <form action="{{ route('admin.students.update', $student) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
            </div>

            <div class="py-4">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $student->code }}">
            </div>

            <div class="py-4">
                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                    value="{{ $student->date_of_birth }}">
            </div>

            <div class="">
                <label class="img">Upload Image</label>
                <input class="form-control" id="img" name="img" type="file" />
                <img src="{{ \Storage::url($student->img) }}" width="100px" alt="">
            </div>

            <div class="py-4">
                <label class="is_active">Is Active</label>
                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Student::Active }}" name="is_active" id="is_active-1"
                        @if ($student->is_active == \App\Models\Student::Active) checked @endif>
                    <label class="form-check-label mb-0" for="is_active-1">Active</label>
                </div>

                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Student::IsActive }}" name="is_active" id="is_active-2"
                        @if ($student->is_active == \App\Models\Student::IsActive) checked @endif>
                    <label class="form-check-label mb-0" for="is_active-2">Is Active</label>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
@endsection
