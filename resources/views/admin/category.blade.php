@extends('admin.layouts.base')

@section('title_page')
    <h1>{{ __('admin.title_page_category') }}</h1>
@endsection

@section('content')
    <section class="content layout-template layout-categories">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('admin.title_all_category') }}
                    ({{ $dataTotal['totalCategory'] }})
                </h3>
                <div class="card-tools">
                    <button class="btn btn-primary" id="btnNewCategory">New Category</button>
                    <form action="{{ route('admin.categories.index') }}" method="GET" class='form-search'>
                        <input type="text" name='data' placeholder="{{ __('admin.placeholder_input_search') }}"
                            @if (request()->data) value="{{ request()->data }}" @endif>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total Blog</th>
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
                                <td>{{ $category->blogs->count() }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td class="options-blog-item">
                                    <button class="btn btn-info btn-sm btn-update-category">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-delete-category">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="box-component">
                                @include('layouts.components.popup_delete', [
                                    'action' => route('admin.categories.delete', ['category' => $category]),
                                    'classname' => 'box-delete-category',
                                ])
                            </div>
                            <div class="box-component">
                                @include('layouts.components.popup_update', [
                                    'action' => route('admin.categories.update', ['category' => $category]),
                                    'classname' => 'box-update-category',
                                    'title' => 'Update Category',
                                    'dataCurrent' => $category->name,
                                ])
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @include('layouts.components.pagination', ['data' => $categories])
            </div>
        </div>
        <div class="box-category box-add" id="boxNewCategory">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <h2>Create Category</h2>
                <input type="text" name="name" placeholder="Input category name">
                <button>Create</button>
                <i class="fa-solid fa-xmark cancel-box-add"></i>
            </form>
        </div>
        
    </section>
@endsection
