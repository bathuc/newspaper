@php
    $dashboardUrl = Route('admin.dashboard');
    $userNewUrl = url('/user/new');
@endphp

@extends('layouts.admin.index')

@section('content')
    <section class="content-header">
        <h4>Words Management</h4>
        <ol class="breadcrumb">
            <li><a href="{{ $dashboardUrl }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Words</li>
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <div class="box">
                <div class="box-body">
                    {{--<p>Add a word</p>--}}
                    <a href="{{ $userNewUrl }}" class="btn btn-primary btn-flat">new word</a>
                </div>
            </div>

            <div class="box">
                <div class="box-grid-header d-flex justify-content-between align-items-center">
                    <span>From {{ $words->firstItem() }} To {{ $words->lastItem() }} Total: {{ $words->total() }}words</span>
                    <div class="">
                        {!! $words->links() !!}
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>word</th>
                                <th>meaning</th>
                                <th>example</th>
                            </tr>
                            @foreach($words as $word)
                                <tr class="user-row pointer" data-text="{{ $word->id }}">
                                    <td>{{ $word->id }}</td>
                                    <td>{{ $word->word }}</td>
                                    <td>{{ $word->meaning }}</td>
                                    <td>{{ $word->example }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <style>
            .pointer {cursor: pointer;}
        </style>

    </section>
    <script>
        $(document).ready(function(){
            $('.user-row').click(function(){
                console.log();
                window.location.href = 'words/edit/'+$(this).attr('data-text');
            });
            $('.update-sound').click(function(){
                $('#frmSound').submit();
            });
        });
    </script>
@endsection
