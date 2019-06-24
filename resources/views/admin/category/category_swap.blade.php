@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Category Swap Order</h4>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Category</li>
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <div class="box">
                <div class="box-body">
                    <div class="d-flex justify-content-between align-items-center ">
                        <span>Create New Category</span>
                        <a href="{{ route('admin.category') }}" class="btn btn-default btn-flat pull-right">Back</a>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-body">
                    <form id="frmForm" method="post">
                        <div class="form-wrapper w-50">
                            @if(!empty($alert))
                                @if($alert == 'success')
                                    <div class="alert alert-success"> {{ $message }} </div>
                                @elseif($alert == 'error')
                                    <div class="alert alert-danger"> {{ $message }} </div>
                                @endif
                            @endif
                            {{ csrf_field() }}

                            <h5 class="text-primary font-weight-bold">Choose same level category to swap</h5>

                            <div class="form-group row">
                                <label class="col-md-3">Category From</label>
                                <div class="col-md-9">
                                    <select name="from_id" id="select_from" class="form-control">
                                        @if(!empty($categoryList))
                                            @foreach ($categoryList as $category)
                                                @if($category['level'] >= $level)
                                                    <option value="{{ $category['id'] }}" disabled> {!! $category['name_view'] !!} </option>
                                                @else
                                                    <option value="{{ $category['id'] }}" class="font-weight-bold"> {!! $category['name_view'] !!} </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3">Category To</label>
                                <div class="col-md-9">
                                    <select id="select_to" name="to_id" class="form-control">
                                        @if(!empty($categoryList))
                                            @foreach ($categoryList as $category)
                                                @if($category['level'] >= $level)
                                                    <option value="{{ $category['id'] }}" disabled> {!! $category['name_view'] !!} </option>
                                                @else
                                                    <option value="{{ $category['id'] }}" class="font-weight-bold"> {!! $category['name_view'] !!} </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary btn-submit">Swap</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
