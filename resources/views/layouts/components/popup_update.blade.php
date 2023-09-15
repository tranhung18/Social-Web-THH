@props(['action', 'classname', 'title', 'dataCurrent'])

<div class="box-update {{ $classname }}">
    <div class="layout">
        <h2>{{ $title }}</h2>
        <form class="form-request" action="{{ $action }}" method="POST">
            @method('PUT')
            @csrf
            <input type="text" name='data' value="{{ $dataCurrent }}" placeholder="Input your new data">
            <button class="btn btn-update">Save Changes</button>
            <i class="fa-solid fa-xmark cancel-global-update"></i>
        </form>
    </div>
</div>

@vite(['resources/js/component.js'])
