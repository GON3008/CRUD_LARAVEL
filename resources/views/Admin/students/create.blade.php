@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>List Of Car</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">List Of Car</li>
            </ol>
        </nav>
    </div>

    @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <div class="container">
        <form action="{{ route('admin.students.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code">
                @error('code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                @error('date_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="">
                <label class="img">Upload Image</label>
                <input class="form-control" id="img" name="img" type="file" />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label class="is_active">Is Active:</label>
                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Student::Active }}" name="is_active" id="is_active-1">
                    <label class="form-check-label mb-0" for="is_active-1">Active</label>
                </div>

                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Student::IsActive }}" name="is_active" id="is_active-2">
                    <label class="form-check-label mb-0" for="is_active-2">Is Active</label>
                </div>
                @error('is_active')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
@endsection
