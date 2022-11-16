@extends('backend.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="">
                                    <h3 for="example-text-input"></h3>

                                    <h2>{{$category->name}}</h2>
                                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning">Edit</a>
                                    
                                </div><br><br><br>

                            </div>
                            <div class="card-body">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
