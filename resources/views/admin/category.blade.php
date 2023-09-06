@extends('admin.layouts.base')

@section('title_page')
  <h1>{{ __('admin.title_page_category') }}</h1>
@endsection

@section('content')
    <section class="content layout-template layout-categories">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('admin.title_all_category')}} 
                    ({{ $dataTotal['totalCategory'] }})
                </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-primary">New Category</a>
                    <form action="#" method="GET" class='form-search'>
                        <input type="text" name='data' placeholder="{{ __('admin.placeholder_input_search') }}"
                            @if (request()->data) value="{{ request()->data}}" @endif
                        >
                        <button>
                            <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="overflow-x:auto;">
                <table border='1px' class="table table-categories table-striped projects">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-4">Name</th>
                            <th class="col-1">Status</th>
                            <th class="col-2">Created_at</th>
                            <th class="col-2">Updated_at</th>
                            <th class="col-2">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ Str::limit($category->name, 30) }}</td>
                                <td>{{ $category->status }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td class="options-blog-item">
                                    <form action="#" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <a class="btn btn-info btn-sm" href="#">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
