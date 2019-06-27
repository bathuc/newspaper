@extends('layouts.frontend.index')

@section('content')
    <div class="pt-5"></div>
    @if($postList->count())
        @foreach ($postList as $post)
            <div class="content-title">
                <a class="post-title" href="{{ route('front.route_name', $post->route) }}">{{ $post->title }}</a> <br>
            </div>
        @endforeach
        {{ $postList->links() }}
    @else
        <h2 class="text-danger">Content not found</h2>
    @endif
    <style>
        .content-title {
            margin-bottom: 15px;
        }
        .post-title{
            font-size: 20px;
            line-height: 30px;
        }
    </style>
@endsection