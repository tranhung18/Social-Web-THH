@extends('admin.layouts.base')

@section('title_page')
    <h1>{{ __('admin.title_page_blog') }}</h1>
@endsection

@section('content')
    <section class="content layout-template layout-blogs">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('admin.title_all_blog') }} ({{ $dataTotal['totalBlog'] }})
                </h3>
                <div class="card-tools">
                    <a href="{{ route('blog.create') }}" class="btn btn-primary">New Blogs</a>
                    <select class="select-item item-tools" id="selectStatusBlog">
                        <option value="{{ route('admin.blog.index') }}" @if (!request()->status) selected @endif>
                            Select Status</option>
                        <option value="{{ route('admin.blog.index', ['status' => App\Models\Post::STATUS_APPROVED]) }}"
                            @if (request()->status == App\Models\Post::STATUS_APPROVED) selected @endif>
                            Approved
                        </option>
                        <option value="{{ route('admin.blog.index', ['status' => App\Models\Post::STATUS_NOT_APPROVED]) }}"
                            @if (request()->status == App\Models\Post::STATUS_NOT_APPROVED) selected @endif>
                            Not Approved
                        </option>
                    </select>
                    <select class="select-item item-tools" id="selectCategory">
                        <option value="{{ route('admin.blog.index') }}" @if (!request()->id) selected @endif>
                            Select Category</option>
                        @foreach ($categories as $category)
                            {{ ['id' => $id, 'name' => $name] = $category }}
                            <option value="{{ route('admin.blog.index', ['id' => $id]) }}"
                                @if (request()->id == $id) selected @endif>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    <form action="{{ route('admin.blog.index') }}" method="GET" class='item-tools form-search'>
                        <input name='dataSearch' placeholder="{{ __('admin.placeholder_input_search') }}"
                            @if (request()->dataSearch) value="{{ request()->dataSearch }}" @endif>
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
                <table border='1px' class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class='col-3'>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Interactive</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td class='image-blog'>
                                    <img alt="Avatar" class="table-avatar" src="{{ Storage::url($blog->image) }}">
                                </td>
                                <td>
                                    {!! nl2br(e(Str::limit($blog->title, 50))) !!}
                                </td>
                                <td>{{ $blog->categories->name }}</td>
                                <td class="project-state status-blog">
                                    <form action="{{ route('admin.blog.update.status', ['blog' => $blog]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if ($blog->status === App\Models\Post::STATUS_APPROVED)
                                            <button class="btn badge-success btn-sm">
                                                {{ __('admin.btn_approved') }}
                                            </button>
                                        @else
                                            <button class="btn badge-warning btn-sm">
                                                {{ __('admin.btn_unapproved') }}
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td class='interactive'>
                                    <p class="total-like">
                                        <i class="fa-solid fa-heart"></i>
                                        {{ $blog->likes()->count() }}
                                    </p>
                                    <p class="total-comment">
                                        <i class="fa-solid fa-comment"></i>
                                        {{ $blog->comments()->count() }}
                                    </p>
                                </td>
                                <td class="options-blog-item">
                                    <a target="_blank" class="btn btn-primary btn-sm"
                                        href="{{ route('blog.detail', ['blog' => $blog]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('blog.edit', ['blog' => $blog]) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn-delete-blog">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="box-component">
                                @include('layouts.components.popup_delete', [
                                    'action' => route('admin.blog.delete', ['blog' => $blog]),
                                    'classname' => 'box-delete-blog',
                                ])
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @include('layouts.components.pagination', ['data' => $blogs])
            </div>
        </div>
    </section>
@endsection
