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





<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Registrar
        </button>
    </div>
</div>