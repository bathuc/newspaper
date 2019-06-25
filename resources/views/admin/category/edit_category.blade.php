@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Edit Category</h4>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="box-header">
                <div class="d-flex justify-content-between align-items-center ">
                    <span>Edit Category</span>
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
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-md-3">Parent Category</label>
                                        <div class="col-md-9">
                                            <select name="parent_id" class="form-control">
                                                <option value="0" class="font-weight-bold">Root Category</option>
                                                @if(!empty($categoryList))
                                                    @foreach ($categoryList as $item)
                                                        @if($item['id'] != $category->id)
                                                            @php
                                                                $selected = '';
                                                                if($item['id'] == $category['parent_id']){
                                                                    $selected = 'selected';
                                                                }
                                                            @endphp
                                                            @if($item['level'] >= $level)
                                                                <option value="{{ $item['id'] }}" disabled {{ $selected }}> {!! $item['name_view'] !!} </option>
                                                            @else
                                                                <option value="{{ $item['id'] }}" class="font-weight-bold" {{ $selected }}> {!! $item['name_view'] !!} </option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3">Category Name</label>
                                        <div class="col-md-9">
                                            <input name="name" type="text" class="form-control" value="{{ $category->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-primary btn-submit">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-body w-50">
                    <h5>Category Enable/Disable </h5>

                    <div class="row">
                        <label class="col-md-3">Enable Category</label>
                        <?php $active = ($category->active_flg)? 'checked' : ''; ?>
                        <div class="col-md-5 row">
                            <label class="switch">
                                <input class="category-status" type="checkbox" {{ $active }}>
                                <span class="slider round"></span>
                            </label>
                            <p class="status-title">{{ $active ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('.category-status').on('change',function(){
                var checked = $(this).is(':checked') ? 1 : 0;
                var status = checked ? 'Yes' : 'No';

                $('.status-title').html(status);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    type: 'post',
                    url:  '{{ route('admin.active_category', $category->id) }}',
                    data: {
                        'active': checked,
                    },
                    success: function(response) {

                    }
                });
            });
        });
    </script>
@endsection
