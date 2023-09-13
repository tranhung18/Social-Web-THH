@extends('admin.layouts.base')

@section('title_page')
    <h1>{{ __('admin.user.title_page') }}</h1>
@endsection

@section('content')
    <section class="content layout-template layout-users">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('admin.user.title_total') }}
                    ({{ $dataTotal['totalUser'] - 1 }})
                </h3>
                <div class="card-tools">
                    <select type="text" name="role" class="select-item item-tools" id="selectRole">
                        <option value="{{ route('admin.user.index') }}" @if (!request()->type) checked @endif>Select Role</option>
                        <option
                            value="{{ route('admin.user.index', [
                                'type' => 'role',
                                'check' => App\Models\User::ROLE_ADMIN,
                            ]) }}"
                            @if (request()->type === 'role' && request()->check == App\Models\User::ROLE_ADMIN) selected @endif>
                            {{ __('admin.user.text_role.admin') }}
                        </option>
                        <option
                            value="{{ route('admin.user.index', [
                                'type' => 'role',
                                'check' => App\Models\User::ROLE_USER,
                            ]) }}"
                            @if (request()->type === 'role' && request()->check == App\Models\User::ROLE_USER) selected @endif>
                            {{ __('admin.user.text_role.user') }}
                        </option>
                    </select>
                    <select type="text" name="status" class="select-item item-tools" id="selectStatus">
                        <option value="" @if (!request()->type) checked @endif>Select Status</option>
                        <option
                            value="{{ route('admin.user.index', [
                                'type' => 'status',
                                'check' => App\Models\User::STATUS_ACTIVE,
                            ]) }}"
                            @if (request()->type === 'status' && request()->check == App\Models\User::STATUS_ACTIVE) selected @endif>
                            {{ __('admin.user.text_status.active') }}
                        </option>
                        <option
                            value="{{ route('admin.user.index', [
                                'type' => 'status',
                                'check' => App\Models\User::STATUS_INACTIVE,
                            ]) }}"
                            @if (request()->type === 'status' && request()->check == App\Models\User::STATUS_INACTIVE) selected @endif>
                            {{ __('admin.user.text_status.inactive') }}
                        </option>
                    </select>
                    <form action="{{ route('admin.user.index') }}" method="GET" class='form-search item-tools'>
                        <input type="text" name='dataSearch' placeholder="{{ __('admin.placeholder_input_search') }}"
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
                <table border='1px' class="table table-categories table-striped projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th class="created-user">Created at</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="avatar-user">
                                    <img src="{{ Storage::url($user->avatar) }}" alt="user-avatar"
                                        class="img-circle img-fluid">
                                </td>
                                <td>{{ $user->user_name }}</td>
                                <td class="avatar-user">{{ $user->email }}</td>
                                <td class="status-role-user">
                                    <form action="{{ route('admin.user.update.status', ['user' => $user]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if ($user->status == App\Models\User::STATUS_ACTIVE)
                                            <button class="btn-success">{{ __('admin.user.text_status.active') }}</button>
                                        @else
                                            <button class="btn-danger">{{ __('admin.user.text_status.inactive') }}</button>
                                        @endif
                                    </form>
                                </td>
                                <td class="status-role-user">
                                    <form action="{{ route('admin.user.update.role', ['user' => $user]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if ($user->role == App\Models\User::ROLE_ADMIN)
                                            <button class="btn-primary">{{ __('admin.user.text_role.admin') }}</button>
                                        @else
                                            <button class="btn-warning">{{ __('admin.user.text_role.user') }}</button>
                                        @endif
                                    </form>

                                </td>
                                <td class="created-user">{{ $user->created_at }}</td>
                                <td class="options-user-item">
                                    <a target="_blank" class="btn btn-primary btn-sm"
                                        href="{{ route('admin.user.profile', ['user' => $user]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm btn-delete-user">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="box-component">
                                @include('layouts.components.popup_delete', [
                                    'action' => route('admin.user.delete', ['user' => $user]),
                                    'classname' => 'box-delete-user',
                                ])
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @include('layouts.components.pagination', ['data' => $users])
            </div>
        </div>
    </section>
    @vite(['resources/js/admin.js'])
@endsection
