@php
    $copyright = 'Admin LTE';
    $copyrightYear = '2018';
    $logoutUrl = route('admin.logout');
    $loginUrl = route('admin.login');
    $adminName = isset($admin->name)? $admin->name : 'Admin';
    $adminURl = url('/admin');

    $userImageUrl = asset('adminlte/imgs/user-default.jpg');
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $copyright }}</title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! Html::style('adminlte/css/bootstrap.min.css') !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    {!! Html::style('adminlte/css/font-awesome.min.css') !!}
    {!! Html::style('adminlte/css/ionicons.min.css') !!}
    {!! Html::style('adminlte/css/AdminLTE.min.css') !!}
    {!! Html::style('adminlte/css/skin-blue.min.css') !!}
    {!! Html::style('adminlte/css/style.css') !!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    {!! Html::script('adminlte/js/jquery.min.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment-with-locales.min.js"></script>
    {!! Html::script('adminlte/js/bootstrap.min.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    {!! Html::script('adminlte/js/adminlte.min.js') !!}
    {!! Html::script('adminlte/js/jquery.validate.js') !!}

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
        <a href="{{ $loginUrl }}" class="logo">
            <span class="logo-mini"><b>ALT</b></span>
            <span class="logo-lg"><b>{{ $copyright }}</b></span>
        </a>

        <nav class="navbar" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="image-wrapper dropdown-toggle d-flex w-100 h-100" data-toggle="dropdown">
                            <img src="{{ $userImageUrl }}" class="user-image" alt="User Image">
                            <span class="d-none d-sm-block">{{ $adminName }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a  class="btn btn-default btn-flat" href="{{ $logoutUrl }}">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ $userImageUrl }}" class="rounded-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ $adminName }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            @include('layouts.admin.sidebar')
        </section>
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            {{ $copyright }}
        </div>
        <strong>Copyright &copy; {{ $copyrightYear }} <a href="{{ $adminURl }}">{{ $copyright }}</a>.</strong> All rights reserved.
    </footer>
        <script src="https://cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
        {{-- <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>--}}
        {{-- <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>--}}
        <script>
            $(document).ready(function () {
                CKEDITOR.replace( 'editor', {
                    height: '500px',
                    filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                    filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                    filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                    filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                    filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                    filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                } );
            });
        </script>
</div>
</body>
</html>
