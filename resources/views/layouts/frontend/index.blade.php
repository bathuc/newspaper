<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Title</title>
    {!! Html::style('front/css/bootstrap.min.css') !!}
    {!! Html::style('front/css/style.css') !!}

    {!! Html::script('front/js/jquery.min.js') !!}
    {!! Html::script('front/js/jquery.validate.js') !!}
    {!! Html::script('front/js/popper.min.js') !!}
    {!! Html::script('front/js/bootstrap.min.js') !!}
    {!! Html::script('front/js/common.js') !!}
</head>
<body>
    @include('layouts.frontend.header')
    <div class="container">
        @yield('content')
    </div>
    @yield('script')
</body>
</html>
