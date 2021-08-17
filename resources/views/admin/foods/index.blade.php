@extends('layouts.app')

@section('title', $title ?? __('global.titles.foods_index'))

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
                                <th>{{ __('foods.thead.name') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($foods as $foods)
                                <tr>
                                    <td class="align-middle" nowrap>{{ $foods->id }}</td>
                                    <td class="align-middle">{{ $foods->name }}</td>
                                    <td class="align-middle text-right">
                                        {{ Form::open(['route' => ['admin.foods.destroy', $foods->id], 'class' => 'confirmDelete']) }}
                                        <div class="btn-group btn-group-sm">
                                            @can('acl.view', 'admin.foods.edit')
                                                <a href="{{route('admin.foods.edit', $foods->id)}}"
                                                   class="btn btn-primary" data-toggle="tooltip"
                                                   title="{{ __('global.titles.attr_edit') }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('acl.view', 'admin.foods.destroy')
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
