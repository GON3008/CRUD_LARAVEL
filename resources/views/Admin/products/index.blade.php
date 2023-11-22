@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>List Of Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Home</a></li>
                <li class="breadcrumb-item active">List Of Product</li>
            </ol>
        </nav>
    </div>

    @if (\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Datatables</h5>
                            {{-- <a href="{{ route('admin.cars.create') }}">
                                <i class="bi bi-plus-circle-fill"></i> Add</a> --}}

                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>id#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Price Sale</th>
                                    <th data-type="" data-format="">Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset($item->img) }}" style="width: 100px">
                                        </td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->price_sale }}</td>
                                        <td> {{ $item->is_active ? 'Active' : 'In Active' }}</td>
                                        <td class="">
                                            <span>
                                                <a href="{{ route('admin.products.edit', $item) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </span>

                                            <span>
                                                <form class="d-inline"
                                                    action="{{ route('admin.products.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn"
                                                        onclick="return confirm('Có chắc xóa không?')">
                                                        <i class="bi bi-trash-fill text-danger"></i>
                                                    </button>
                                                </form>

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
