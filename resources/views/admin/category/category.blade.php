@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Category Management</h4>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Category</li>
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <div class="box">
                <div class="box-header">
                    <div class="d-flex justify-content-between align-items-center ">
                        <a href="{{ route('admin.new_category') }}" class="btn btn-primary btn-flat">New Category</a>
                        <a href="{{ route('admin.category_swap_order') }}" class="btn btn-primary btn-flat">Swap category order</a>
                    </div>

                </div>
            </div>

            <div class="box">
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                        </tr>
                        @if(!empty($categoryList))
                            @foreach ($categoryList as $category)
                                <tr class="category-row pointer" data-id="{{ $category['id'] }}">
                                    <td>{{ $category['id'] }}</td>
                                    <td>{!! $category['name_view'] !!} </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function () {
            $('.category-row').click(function(){
            	var categoryId = $(this).data('id');
            	window.location = '/admin/category/edit/' + categoryId;
            });
        });
    </script>
@endsection
