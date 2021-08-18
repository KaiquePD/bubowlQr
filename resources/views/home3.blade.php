@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md" >          
              <div class="card-header">{{ __('Dashboard') }}</div>
            <div class="card">
                <div id="editor"></div> 
            </div>
        </div>
        
    </div>


</div>
<script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        var btn = document.querySelector('#btn');

        btn.addEventListener("click", function () {
        var conteudo = document.querySelector('.ql-editor').innerHTML;
        document.querySelector('#texto').value = conteudo;
        document.querySelector('form').submit();
        });
    </script>
  });
    </script>
@endsection
