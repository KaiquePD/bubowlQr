<h5 class="header-title">@yield('title')</h5>
<div class="card-body">
    <div class="row">
        <div class="col-5">
            <div class="form-group">
                {{ Form::label('name', __('users.label.name'), ['class' => 'required']) }}
                {{ Form::text('name', null, [
                    'id' => "name",
                    'placeholder' => __('users.placeholder.name'),
                    'class' => "form-control",
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>
</div>
