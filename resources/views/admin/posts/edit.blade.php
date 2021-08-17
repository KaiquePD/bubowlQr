@extends('admin.master')

@section('title', $title ?? __('global.titles.posts_edit'))

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                @include('admin.partials.breadcrumb')
                <h4 class="page-title">@yield('title')</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            @include('admin.components.session-message')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {{ Form::model($post, ['class' => '', 'route' => ['admin.posts.edit', $post->id], 'files' => true]) }}
            {{ Form::hidden('_method', 'POST') }}
            {{ Form::hidden('id') }}
            <div class="card-box">
                @include('admin.posts.blocks.form')
            </div>
            <button type="submit" class="btn btn-success btn-block">{{ __('global.button.save') }}</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection

