@extends('users.layouts.app')

@section('content')
    <div class="layout-detail">
        <div class="layout-detail-item info-blog">
            <div class="dashboard">
                <a href="{{ route('blogs.home') }}">{{ __('blog.title_home') }}</a>
                <i class="fa-solid fa-chevron-right"></i>
                <p>{{ __('blog.title_detail_blog') }}</p>
            </div>
            <div class="detail-blog">
                <h3>{{ $blog->title }}</h3>
                <div class="header-blog">
                    <div class="auth">
                        <img src="{{ Storage::url($blog->user->avatar) }}" alt="">
                        <div class="info">
                            <p class="name">{{ $blog->user->user_name }}</p>
                            <p>{{ $blog->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    @if (Auth::check())
                        <div class="control">
                            @if (Auth::user()->role == \App\Models\User::ROLE_ADMIN || Auth::id() == $blog->user_id)
                                @if($blog->status == \App\Models\Post::STATUS_NOT_APPROVED)
                                    <div class="item-status not-approved">{{ __('blog.btn_not_approved') }}</div>
                                @else
                                    <div class="item-status approved">{{ __('blog.btn_approved') }}</div>
                                @endif
                            @endif
                            @can ('update', $blog)
                                <a class="item-status update-blog" href="{{ route('blog.edit', ['blog' => $blog]) }}">
                                    {{ __('blog.btn_update_blog') }}
                                </a>
                            @endcan
                            @can('delete', $blog)
                                <button class="item-status delete-blog btn-delete-blog">{{ __('blog.btn_delete_blog') }}</button>
                            @endcan
                        </div>
                    @endif
                </div>
                <div class="img-blog">
                    <img src="{{ Storage::url($blog->image) }}" alt="">
                </div>
                <div class="info-interactive">
                    <div class="interactive-item like">
                        @if (Auth::check())
                            @if ($statusLike)
                                <i class="interactive fa-solid fa-heart" data-route='{{ route('interactive', ['idBlog' => $blog->id ]) }}'></i>
                            @else
                                <i class="interactive fa-regular fa-heart" data-route='{{ route('interactive', ['idBlog' => $blog->id ]) }}'></i>
                            @endif
                        @else
                            <i class="fa-regular fa-heart"></i>
                        @endif
                        <p class="total-like">{{ $totalLike }}</p>
                    </div>
                    <div class="interactive-item comment">
                        <a href="#boxComment"><i class="fa-solid fa-comment"></i></a>
                        <p class="total-comment">{{ $totalComment }}</p>
                    </div>
                </div>
                <div class="content">
                    <p>{!! nl2br(e($blog->content)) !!}</p>
                </div>
            </div>
        </div>
        <div class="layout-detail-item related">
            <div class="title">{{ __('blog.title_related') }}</div>
            <div class="line-title"></div>
            <div class="list-blog-related related-img">
                @foreach ($relatedBlogs as $item)
                    <a href="{{ route('blog.detail', ['blog'=> $item]) }}" class="item-blog">
                        <div class="img-blog">
                            <img src="{{ Storage::url($item->image) }}" alt="">
                        </div>
                        <div class="title-blog">{{ $item->title }}</div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="layout-detail-item comments" id="boxComment">
            <div class="title">{{ __('blog.title_comments') }}</div>
            <div class="line-title"></div>
            @if (Auth::check())
                <div class="send-comment">
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="">
                    <textarea name="content" id="contentComment" placeholder="Input your comment . . . . "></textarea>
                    <button data-route="{{ route('comment.store', ['blog' => $blog]) }}" id="sendComment">
                        {{ __('comment.btn_send_comment') }}
                    </button>
                </div>
            @endif
            <div class="all-comment">
                @include ('layouts.components.item_comment', ['comments', $comments])
            </div>
            @if ($blog->comments()->count() > 5)
                <div id="viewMoreComment"
                    class="show-all-comment" 
                    data-id="{{ $blog->id }}" 
                    data-route="{{ route('comment.view.more') }}"
                    data-page-last="{{ $comments->lastPage() }}"
                >
                    {{ __('blog.text_view_more') }}
                </div>
            @endif
        </div>
    </div>
    <div class="box-component">
        @include('layouts.components.popup_delete', [
            'action' => route('blog.delete', ['blog' => $blog]),
            'classname' => 'box-delete-blog',
        ])
    </div>

    @vite(['resources/js/detail.js'])
    @vite(['resources/js/comment.js'])
@endsection
