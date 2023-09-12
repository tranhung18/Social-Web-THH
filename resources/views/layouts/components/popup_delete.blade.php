@props(['action', 'classname'])

<div class="box-delete {{ $classname }}">
    <div class="layout">
        <div class="header-box">
            <p>{{ __('admin.component.box_delete.title') }}</p>
            <i class="fa-solid fa-xmark cancel-global"></i>
        </div>
        <div class="question-box">
            <p>{{ __('admin.component.box_delete.content') }}</p>
        </div>
        <form class="form-request" action="{{ $action }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="box-btn">
                <button class="btn btn-delete" type="submit">{{ __('admin.form.btn.delete') }}</button>
                <div class="btn btn-cancel cancel-box-delete">{{ __('admin.form.btn.cancel') }}</div>
            </div>
        </form>
    </div>
</div>

@vite(['resources/js/component.js'])
