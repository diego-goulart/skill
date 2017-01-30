<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
    <label for="subject" class="col-md-4 control-label">Nome</label>

    <div class="col-md-6">
        {!! Form::text('subject', @old('subject'), ['class' => 'form-control', 'required', 'autofocus']) !!}

        @if ($errors->has('subject'))
            <span class="help-block">
                <strong>{{ $errors->first('subject') }}</strong>
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


<div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Descrição</label>

    <div class="col-md-6">
        {!! Form::number('value', @old('value'), ['class' => 'form-control', 'required', 'step' => 0.1, 'max' => 100]) !!}

        @if ($errors->has('value'))
            <span class="help-block">
                <strong>{{ $errors->first('value') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

    <div class="col-md-6 col-md-offset-4">

        <a href="{{route('admin.questions.index')}}"
           class="btn btn-default">
            Voltar</a>

        {!! Form::submit('Salvar', ['class' => "btn btn-primary"]) !!}


    </div>
</div>