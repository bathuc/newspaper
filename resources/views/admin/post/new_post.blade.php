@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Create New Post</h4>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="box-header">
                <div class="d-flex justify-content-between align-items-center ">
                    <span>Create New Post</span>
                    <a href="{{ route('admin.post') }}" class="btn btn-default btn-flat pull-right">Back</a>
                </div>
            </div>

            <div class="box">
                <div class="box-body">

                    <div class="box-bor clearfix">
                        @if(empty($categoryList))
                            <h3 class="text-danger">You need to create category first!</h3>
                        @else
                            <h5>Post Information</h5>

                            <div class="box-content">
                                <form id="frmForm" method="post" class="d-flex justify-content-center">
                                    {{ csrf_field() }}
                                    <div class="form-wrapper w-75">

                                        <div class="form-group">
                                            <label class="font-weight-bold">category</label>
                                            <select name="category_id" class="form-control">
                                                @if(!empty($categoryList))
                                                    @foreach ($categoryList as $category)
                                                        <option value="{{ $category['id'] }}" class="font-weight-bold"> {!! $category['name_view'] !!} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Title</label>
                                            <input id="title" name="title" type="text" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Content</label>
                                            <textarea id="editor" name="content" type="text" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label ></label>
                                            <button type="button" class="btn btn-primary btn-submit btn-lg">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $("#frmForm").validate({
                rules: {
                    title: { required: true },
                    content: { required: true },
                },
            });

            $('.btn-submit').click(function(){
                if ($("#frmForm").valid()) {
                    $("#frmForm").submit();
                }
            });
        });
    </script>
@endsection
