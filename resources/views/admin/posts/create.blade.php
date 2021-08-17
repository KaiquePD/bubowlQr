@extends('layouts.app')

@section('title', $title ?? __('global.titles.posts_create'))

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            {{ Form::open(['class' => '', 'files' => true]) }}
            <div class="card-box">
                @include('admin.posts.blocks.form')
            </div>
            <button type="submit" class="btn btn-success btn-block">{{ __('global.button.save') }}</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>

@endsection
