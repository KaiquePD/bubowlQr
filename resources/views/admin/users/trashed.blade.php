@extends('admin.master')

@section('title', $title ?? __('global.titles.users_trashed'))

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
        @include('admin.partials.searchbar', ['route' => 'users', 'trashed' => true])
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title">@yield('title')</h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('users.thead.name') }}</th>
                                <th>{{ __('users.thead.deleted') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="align-middle">{{ $user->id }}</td>
                                    <td class="align-middle" nowrap>{{ $user->name }}</td>
                                    <td class="align-middle" nowrap>{{ $user->deleted_at }}</td>
                                    <td class="align-middle text-right">
                                        {{ Form::open(['route' => ['admin.users.forceDelete', $user->id], 'class' => 'confirmDelete']) }}
                                        <div class="btn-group btn-group-sm">
                                            @can('acl.view', 'admin.users.restore')
                                                <a href="{{ route('admin.users.restore', [$user->id]) }}" class="btn btn-info"
                                                   data-toggle="tooltip" title="{{ __('global.titles.attr_restore') }}">
                                                    <i class="mdi mdi-delete-restore"></i> {{ __('global.titles.attr_restore') }}
                                                </a>
                                            @endcan
                                            @can('acl.view', 'admin.users.forceDelete')
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <button class="btn btn-outline-danger" type="submit"
                                                        data-toggle="tooltip"
                                                        title="{{ __('global.titles.attr_delete') }}">
                                                    <i class="mdi mdi-delete-forever"></i>
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
    @include('admin.components.pagination', ['pagination' => $users])

@endsection
