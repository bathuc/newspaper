@extends('layouts.frontend.index')

@section('content')
    <div class="pt-5"></div>
    @if(!empty($postList))
        @foreach ($postList as $post)
            <a class="post-title" href="{{ route('front.route_name', $post->route) }}">{{ $post->title }}</a> <br>
        @endforeach
        {{ $postList->links() }}
    @endif
    <style>
        .post-title{
            font-size: 20px;
            line-height: 30px;
        }
    </style>
@endsection