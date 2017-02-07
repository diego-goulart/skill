<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

    {!! Form::label('password', 'Senha:', ['class' => "col-md-4 control-label text-right"]) !!}

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


<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

    {!! Form::label('password_confirmation', 'Confirme a Senha:', ['class' => "col-md-4 control-label text-right"]) !!}

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::password('password_confirmation', ['class'=>'form-control', 'required']) !!}
        </div>

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
</div>



<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Alterar Senha
        </button>
    </div>
</div>