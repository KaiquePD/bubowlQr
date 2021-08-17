<h5 class="header-title">@yield('title')</h5>
<div class="card-body">
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                {{ Form::label('title', __('posts.label.title'), ['class' => 'required']) }}
                {{ Form::text('title', null, [
                    'id' => "title",
                    'placeholder' => __('posts.placeholder.title'),
                    'class' => "form-control",
                    'required' => true
                ]) }}

                {{ Form::label('content', __('posts.label.content'), ['class' => 'required']) }}
                {{ Form::textarea('content', null, [
                    'id' => "content",
                    'placeholder' => __('pages.placeholder.content'),
                    'class' => "form-control",
                    'name' => "content",
                    'required' => true
                ]) }}

                {{ Form::hidden('idUser', Auth::id()) }}
            </div>
        </div>
    </div>
</div>
