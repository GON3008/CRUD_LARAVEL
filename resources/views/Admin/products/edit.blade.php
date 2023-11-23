@extends('layouts.master')
@include('layouts.alaert')

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

    {{-- @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif --}}

    <div class="container">
        <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label for="price_sale" class="form-label">Price Sale</label>
                <input type="number" class="form-control" id="price_sale" name="price_sale"
                    value="{{ $product->price_sale }}">
                @error('price_sale')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="">
                <label class="img">Upload Image</label>
                <input class="form-control" id="img" name="img" type="file" />
                <img src="{{ \Storage::url($product->img) }}" width="100px" alt="">
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="py-4">
                <label class="is_active">Is Active:</label>
                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Product::Active }}"
                        @if ($product->is_active == \App\Models\Product::Active) checked @endif name="is_active" id="is_active-1">
                    <label class="form-check-label mb-0" for="is_active-1">Active</label>
                </div>

                <div class="form-check">
                    <input type="radio" value="{{ \App\Models\Product::IsActive }}"
                        @if ($product->is_active == \App\Models\Product::IsActive) checked @endif name="is_active" id="is_active-2">
                    <label class="form-check-label mb-0" for="is_active-2">Is Active</label>
                </div>
                @error('is_active')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quill Editor Full</h5>

                    <!-- Quill Editor Full -->
                    <div class="quill-editor-full py-5">
                        <p name="description" id="description">{{ $product->description }}</p>
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
