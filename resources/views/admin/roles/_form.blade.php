<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Nome</label>

    <div class="col-md-6">
        {!! Form::text('name', @old('name'), ['class' => 'form-control', 'required', 'autofocus']) !!}

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Descrição</label>

    <div class="col-md-6">
        {!! Form::textarea('description', @old('description'), ['class' => 'form-control', 'required']) !!}

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

    <div class="col-md-6 col-md-offset-4">

        <a href="{{route('admin.roles.index')}}"
           class="btn btn-default">
            Voltar</a>

        {!! Form::submit('Salvar', ['class' => "btn btn-primary"]) !!}


    </div>
</div>