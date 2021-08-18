@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @foreach ($user->rests as $rest)
                        <h1>{{$rest->name}}</h1>

                        @foreach ($rest->segments as $segment)
                            <h2>{{ $segment->name }}</h2>
                            <table id="dataTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($segment->food as $food)
                                    <tr>
                                        <td>{{ $food->name }}</td>
                                        <td>{{ $food->desc }}</td>
                                        <td>R$ {{ $food->price }}</td>
                                        <td>{{ $food->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endforeach
                    <script>
    $(document).ready(function () {
    $.noConflict();
    var table = $('#dataTable').DataTable();
    });
    </script>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
