<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

    {!! Form::label('name', 'Nome:', ['class' => "col-md-4 control-label"]) !!}

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::text('name', @old('name'), ['class'=>'form-control', 'required', 'autofocus']) !!}
        </div>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('matricula') ? ' has-error' : '' }}">

    {!! Form::label('matricula', 'Matrícula:', ['class' => "col-md-4 control-label"]) !!}

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::text('matricula', @old('matricula'), ['class'=>'form-control', 'required']) !!}
        </div>

        @if ($errors->has('matricula'))
            <span class="help-block">
                <strong>{{ $errors->first('matricula') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

    {!! Form::label('password', 'Senha:', ['class' => "col-md-4 control-label"]) !!}

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::password('password', ['class'=>'form-control', 'required']) !!}
        </div>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">

    {!! Form::label('password-confirm', 'Confirme a Senha:', ['class' => "col-md-4 control-label"]) !!}

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::password('password-confirm', ['class'=>'form-control', 'required']) !!}
        </div>

        @if ($errors->has('password-confirm'))
            <span class="help-block">
                <strong>{{ $errors->first('password-confirm') }}</strong>
            </span>
        @endif
    </div>
</div>



<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Registrar
        </button>
    </div>
</div>