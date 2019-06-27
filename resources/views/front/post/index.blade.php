@extends('layouts.frontend.index')

@section('content')
    <div class="pt-3"></div>
    <h1>{{ $post->title }}</h1>
    <div class="content">
        {!! $post->content !!}
    </div>

    <div class="pt-3"></div>

    <style>
        .content{
            width: 800px;
            font-size: 20px;
            line-height: 28px;
        }

        img{
            width: 800px!important;
            height: auto!important;
        }

        @media only screen and (max-width: 600px) {
            .content{
                width: 340px;
                font-size: 16px;
                line-height: 28px;
            }
            img{
                width: 340px!important;
                height: auto!important;
            }
        }
    </style>
@endsection