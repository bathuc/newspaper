@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Post Management</h4>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Post</li>
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <div class="box">
                <div class="box-body">
                    {{--<p>Add a word</p>--}}
                    <a href="{{ route('admin.new_post') }}" class="btn btn-primary btn-flat">New Post</a>
                </div>
            </div>

            <div class="box">
                <div class="box-grid-header d-flex justify-content-between align-items-center">
                    <span>From {{ $posts->firstItem() }} To {{ $posts->lastItem() }} Total: {{ $posts->total() }} post</span>
                    <div class="">
                        {!! $posts->links() !!}
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>category</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr class="post-row pointer" data-id="{{ $post->id }}">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('.post-row').click(function(){
                var postId = $(this).data('id');
                window.location = '/admin/post/edit/' + postId;
            });
        });
    </script>
@endsection
