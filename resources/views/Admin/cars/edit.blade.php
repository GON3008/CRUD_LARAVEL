@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>List Of Car</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.cars.index') }}">Home</a></li>
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
        <form class="" action="{{ route('admin.cars.update', $car) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $car->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}">
                @error('brand')
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

            <div class="py-4">
                <label class="is_active">Is Active:</label>
                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Car::Active }}"
                        @if ($car->is_active == \App\Models\Car::Active) checked @endif name="is_active" id="is_active-1">
                    <label class="form-check-label mb-0" for="is_show-1">Active</label>
                </div>

                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Car::IsActive }}"
                        @if ($car->is_active == \App\Models\Car::IsActive) checked @endif name="is_active" id="is_active-2">
                    <label class="form-check-label mb-0" for="is_show-2">Is Active</label>
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
                        <p name="description" id="description">{{ $car->description }}</p>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
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
