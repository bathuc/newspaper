@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Create New Category</h4>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="box-header">
                <div class="d-flex justify-content-between align-items-center ">
                    <span>Create New Category</span>
                    <a href="{{ route('admin.category') }}" class="btn btn-default btn-flat pull-right">Back</a>
                </div>
            </div>

            <div class="box">
                <div class="box-body">

                    <div class="box-bor clearfix">
                        <h5>Category Information</h5>

                        <div class="box-content">
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
                                    <div class="form-group row">
                                        <label class="col-md-3">Parent Category</label>
                                        <div class="col-md-9">
                                            <select name="parent_id" class="form-control">
                                                <option value="0" class="font-weight-bold">Root Category</option>
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
                                        <label class="col-md-3">Category Name</label>
                                        <div class="col-md-9">
                                            <input name="name" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-primary btn-submit">Create</button>
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
@endsection
