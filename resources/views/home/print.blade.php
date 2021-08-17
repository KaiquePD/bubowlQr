@extends('home.printMaster')

@section('content')
    <figure>
        <img src="{{ $rest->logo_path }}" alt="{{ $rest->name }}">
        <img src="https://chart.googleapis.com/chart?chs=350x350&cht=qr&chl=http://127.0.0.1:8000/{{ $rest->url }}" alt="">
        <figcaption>
            <span>
                <strong>BubowlDev</strong>
                (11) 
            </span>
        </figcaption>
    </figure>
@endsection

