@extends('layouts.admin.base')

@section('title_page')
  <h1>{{ __('admin.title_page_category') }}</h1>
@endsection

@section('content')
<section class="content layout-blogs">
    <div class="card">
        <div class="card-body p-0" style="overflow-x:auto;">
            <table border='1px' class="table table-striped projects">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Options</th>
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
                                    <a target="_blank" class="btn btn-primary btn-sm" href="#">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
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
