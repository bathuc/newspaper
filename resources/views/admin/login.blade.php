<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Title</title>
    {!! Html::style('adminlte/css/bootstrap.min.css') !!}
    {!! Html::style('adminlte/css/style.css') !!}

    {!! Html::script('adminlte/js/jquery.min.js') !!}
    {!! Html::script('adminlte/js/jquery.validate.js') !!}
    {!! Html::script('adminlte/js/popper.min.js') !!}
    {!! Html::script('adminlte/js/bootstrap.min.js') !!}
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <div class="card-body">
                    <div class="login-wrapper">
                        <form id="frmForm" method="post">
                            @csrf
                            <div class="form-wrapper">
                                @if(session()->has('message'))
                                    <div class="alert alert-danger"> {{ session('message') }} </div>
                                @endif
                                <h2 class="mb-3">Login</h2>
                                <div class="form-group ">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="icon-user"></i>
                                            </span>
                                        </div>
                                        <input id="email" name="email" type="text" class="form-control w-75" placeholder="email" value="{{ old('email') }}" autocomplete="off">
                                        <span class="server-error text-danger"> {{ $errors->first('email') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="icon-user"></i>
                                            </span>
                                        </div>
                                        <input id="password" name="password" type="password" class="form-control w-75" placeholder="password"  value="{{ old('password') }}">
                                        <span class="server-error text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .app {
        display: flex;
        min-height: 70vh;
        background-color: #E4E5E6;
    }
</style>
<script>
    $(document).ready(function () {
        $("input").focus(function() {
            $(this).parent().find('.server-error').hide();
        });
        $("#frmForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 255,
                },
                password: {
                    required: true,
                    minlength: 5
                },
            },

        });

        $('.btn-submit').click(function(){
            if ($("#frmForm").valid()) {
                $("#frmForm").submit();
            }
        });
    });
</script>
</body>
</html>
