@extends('layouts.master')
@include('layouts.alert')

@section('content')
    <div class="pagetitle">
        <h1>List Of Car</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.devices.index') }}">Home</a></li>
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
        <form class="" action="{{ route('admin.devices.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="serial" class="form-label">Serial</label>
                <input type="text" class="form-control" id="serial" name="serial">
                @error('serial')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model">
                @error('model')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="">
                <label class="img">Upload Image</label>
                <input class="form-control" id="img" name="img" type="file" />
                @error('img')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-select" id="category_id" aria-label="Default select example">
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}">{{ $id }} - {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="py-4">
                <label class="is_active">Is Active:</label>
                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Device::Active }}" name="is_active" id="is_active-1">
                    <label class="form-check-label mb-0" for="is_active-1">Active</label>
                </div>

                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Device::IsActive }}" name="is_active" id="is_active-2">
                    <label class="form-check-label mb-0" for="is_active-2">Is Active</label>
                </div>
                @error('is_active')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quill Editor Full</h5>

                    <!-- Quill Editor Full -->
                    <div class="quill-editor-full py-5">
                        <p name="description" id="description"></p>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Quill Editor Full -->

                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
@endsection
