@extends('home.menu')

@section('title', $rest->name . ' - Bubowl QRCode System')
@section('color', $rest->color )

@section('content')

        <header>
                <figure>
                        <img src="{{ $rest->logo_path }}" alt="{{ $rest->name }}">
                        <figcaption>
                                <h1>{{ $rest->name }}</h1>
                                <p>{{ $rest->horFunc }}</p>
                                <a href="#">Ver mais</a>
                        </figcaption>
                </figure>
        </header>

        @foreach ($rest->segments as $segment)
                <h2>{{ $segment->name }}</h2>
                <ul>
                        @foreach ($segment->food as $food)
                                @if ( $food->status == 'on')    
                                        <li>
                                                <h3>{{ $food->name }}</h3>
                                                <p>{{ $food->desc }}</p>
                                                <span>R$ {{ $food->price }}</span>
                                        </li>
                                @endif
                        @endforeach
                </ul>
        @endforeach
@endsection

