@extends('admin.layouts.base')

@section('title_page')
  <h1>{{ __('admin.title_page_user') }}</h1>
@endsection

@section('content')
  <section class="content layout-template layout-users">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('admin.title_item_user')}} 
                ({{ $dataTotal['totalUser'] }})
            </h3>
            <div class="card-tools">
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
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="avatar-user">
                              <img src="{{ Storage::url($user->avatar) }}" alt="user-avatar" class="img-circle img-fluid">
                            </td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td class="options-user-item">
                                <form action="#" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <a target="_blank" class="btn btn-primary btn-sm" href="{{ route('admin.user.profile', ['user' => $user]) }}">
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
