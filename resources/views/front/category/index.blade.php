@extends('layouts.frontend.index')

@section('content')
    <div class="pt-5"></div>
    @if($postList->count())
        @foreach ($postList as $post)
            <a class="post-title" href="{{ route('front.route_name', $post->route) }}">{{ $post->title }}</a> <br>
        @endforeach
        {{ $postList->links() }}
    @else
        <h2 class="text-danger">Content not found</h2>
    @endif
    <style>
        .post-title{
            font-size: 20px;
            line-height: 30px;
        }
    </style>
@endsection