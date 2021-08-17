@extends('layouts.app')

@section('title', $title ?? __('global.titles.posts_index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title">@yield('title')</h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('posts.thead.title') }}</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td class="align-middle" nowrap>{{ $post->id }}</td>
                                    <td class="align-middle">{{ $post->title }}</td>
                                    <td class="align-middle text-right">
                                        {{ Form::open(['route' => ['admin.posts.destroy', $post->id], 'class' => 'confirmDelete']) }}
                                        <div class="btn-group btn-group-sm">
                                            @can('acl.view', 'admin.posts.edit')
                                                <a href="{{route('admin.posts.edit', $post->id)}}"
                                                   class="btn btn-primary" data-toggle="tooltip"
                                                   title="{{ __('global.titles.attr_edit') }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('acl.view', 'admin.posts.destroy')
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <button class="btn btn-outline-danger" type="submit"
                                                        data-toggle="tooltip"
                                                        title="{{ __('global.titles.attr_send_to_trash') }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            @endcan
                                        </div>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
