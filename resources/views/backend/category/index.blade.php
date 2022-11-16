@extends('backend.master')
@section('content')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label">Manage category</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    <a href="{{ route('categories.create') }}"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Category</a>
                                </div>
                                <div class="md-3 title_cate">
                                    <a href="#" class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <div class="form-outline">
                                        <form action="">
                                            <input type="search" value="{{ request()->search }}" name="search"
                                                id="form1" class="form-control" />
                                    </div>
                                    <button type="submit" class="btn btn-primary  waves-effect waves-light ">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <table
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="17%">Id</th>
                                        <th>Name</th>
                                        <th>The number of products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    @if (!$categories->count())
                                        <tr>
                                            <td colspan="4">No data yet...</td>
                                        </tr>
                                    @else
                                        @foreach ($categories as $category)
                                            <tr class="item-{{ $category->id }}" class="categoy-{{$category->id}}">
                                                <td>{{ $category->id }}</td>
                                                <td><a
                                                        href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                                                </td>
                                                <td>3</td>
                                                {{-- <td>{{ $category->products->count() }}</td> --}}
                                                <td>
                                                    {{-- @can('Edit_Category', 'Edit_Category') --}}
                                                    <a href="{{ route('categories.create') }}" class="btn btn-info sm">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                    {{-- @endcan
                                                @can('Delete_Category', 'Delete_Category') --}}
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-danger sm ">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    {{-- @endcan
                                                @can('Show_Category', 'Show_Category') --}}
                                                    <a data-href="{{ route('categories.destroy', $category->id) }}"
                                                        class="btn btn-primary sm deleteItems" id="{{ $category->id }}">
                                                        <i class="bi bi-trash"></i>

                                                    </a>
                                                    {{-- @endcan --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                            <div class="row mb-lg-3">
                                {{-- <div class="col-7">
                                Show {{ $categories->perPage() }} - {{ $categories->currentPage() }} of
                                {{ $categories->lastPage() }}
                            </div>
                            <div class="col-5">
                                <div class="btn-group float-end">
                                    {{ $categories->appends(request()->all())->links() }}
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.deleteItems').on('click', function() {
                let id = $(this).attr('id');
                let url = $(this).data('href');
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    id: id,
                    url: url,
                    method: 'delete',
                    data: {
                        _token: csrf
                    },
                    success: function(res) {
                        alert(res.message);
                        $('.item-'+ id).remove();
                        
                    }
                });

            });
        })
    </script>
@endsection
