@extends('layouts.admin.index')

@section('content')
    @php
        $userUrl = url('/user');
    @endphp

    <section class="content-header">
        <h4>Create New User</h4>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="box-header">
                <div class="d-flex justify-content-between align-items-center ">
                    <span>Create New User</span>
                    <a href="{{ $userUrl }}" class="btn btn-default btn-flat pull-right">Back</a>
                </div>
            </div>

            <div class="box">
                <div class="box-body">

                    <div class="box-bor clearfix">
                        <h5>User Information</h5>

                        <div class="box-content">
                            <form id="frmForm" method="post" class="d-flex justify-content-center col-md-6">
                                {{ csrf_field() }}
                                <div class="form-wrapper w-75">

                                    @if(session()->has('alert'))
                                        @if(session('alert') == 'success')
                                            <div class="alert alert-success"> {{ session('message') }} </div>
                                        @elseif(session('alert') == 'error')
                                            <div class="alert alert-danger"> {{ session('message') }} </div>
                                        @endif
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-md-3 font-weight-bold">Name</label>
                                        <div class="col-md-9">
                                            <input id="name" name="name" type="text" class="box_inline form-control w50">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 font-weight-bold">Email</label>
                                        <div class="col-md-9">
                                            <input id="email" name="email" type="text" class="box_inline form-control w50">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 font-weight-bold">Password</label>
                                        <div class="col-md-9">
                                            <input id="password" name="password" type="password" class="box_inline form-control w50">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <button type="button" class="btn btn-primary btn-submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $("#frmForm").validate({
                rules: {
                    name: { required: true },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 60,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },

                }
            });

            $('.btn-submit').click(function(){
                if ($("#frmForm").valid()) {
                    $("#frmForm").submit();
                }
            });
        });
    </script>
@endsection
