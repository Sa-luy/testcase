@extends('backend.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h3 for="example-text-input"></h3>

                                    <h2>New Category</h2>
                                    <form action="{{ route('categories.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input id="title" type="text"
                                                class="@error('name') is-invalid @enderror form-control" name="name"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div><br><br><br>

                            </div>
                            <div class="card-body">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')

    @endsection
