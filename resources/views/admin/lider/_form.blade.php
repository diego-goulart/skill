<div class="form-group{{ $errors->has('ctm_name') ? ' has-error' : '' }}">
    <div class="col-md-12">
        <label for="ctm_name" class="control-label">Razão Social/Nome Cliente:</label>
        {!! Form::text('ctm_name', @old('ctm_name'), ['class' => 'form-control']) !!}

        @if ($errors->has('ctm_name'))
            <span class="help-block">
                <strong>{{ $errors->first('ctm_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('dt_call') ? ' has-error' : '' }}">
    <div class="col-md-3">
        <label for="dt_call" class="control-label">Data da Ligação:</label>
        {!! Form::date('dt_call', @old('dt_call'), ['class' => 'form-control', 'placeholder' => 'dd-mm-yyyy', 'lang' => 'pt_BR','required']) !!}

        @if ($errors->has('dt_call'))
            <span class="help-block">
                <strong>{{ $errors->first('dt_call') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <label for="tm_call" class="control-label">Hora da Ligação:</label>
        {!! Form::text('tm_call', @old('tm_call'), ['class' => 'form-control', 'placeholder'=>'hh:mm:ss', 'required']) !!}

        @if ($errors->has('tm_call'))
            <span class="help-block">
                <strong>{{ $errors->first('tm_call') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <label for="ctm_phone" class="control-label">Telefone Cliente:</label>
        {!! Form::text('ctm_phone', @old('ctm_phone'), ['class' => 'form-control', 'placeholder'=>'DDD - 0000-0000', 'required']) !!}

        @if ($errors->has('ctm_phone'))
            <span class="help-block">
                <strong>{{ $errors->first('ctm_phone') }}</strong>
            </span>
        @endif
    </div>
</div>

@foreach($questions as $question)
    @if(!isset($question->total))
        <div class="row {{@$question->value < 0? 'bg-danger':'bg-success'}}">
            <div class="col col-md-2">
                <b class="text-uppercase {{@$question->value < 0? 'has-error text-danger':'has-success text-success'}}">{{$question->subject}}: </b>
            </div>
            <div class="col col-md-7  {{@$question->value < 0? 'has-error text-danger':'has-success text-success'}}">{{$question->subject}}">
                {{$question->description}}
            </div>
            <div class="col col-md-3 {{@$question->value < 0? 'has-error text-danger':'has-success text-success'}}">
                {{number($question->value, 0)}}&nbsp;&nbsp;&nbsp;
                <label class="radio-inline">
                    <input type="radio" name="{{$question->id}}" id="eval_{{$question->id}}_true"
                           value="true" {{ $question->response=="true" ? 'checked='.'"'.'checked'.'"' : '' }} required>
                    <b>SIM</b>
                </label>

                <label class="radio-inline">
                    <input type="radio" name="{{$question->id}}" id="eval_{{$question->id}}_false"
                           value="false" {{ $question->response=="false" ? 'checked='.'"'.'checked'.'"' : '' }} required>
                    <b>NÃO</b>
                </label>

            </div>
        </div><div class="clearfix"></div><hr>
    @endif
@endforeach


<div class="form-group{{ $errors->has('obs') ? ' has-error' : '' }}">


    <div class="col-md-12">
        <label for="name" class="control-label">Observações:</label>
        {!! Form::textarea('obs', @old('obs'), ['class' => 'form-control']) !!}

        @if ($errors->has('obs'))
            <span class="help-block">
                <strong>{{ $errors->first('obs') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Salvar
        </button>
        {!! link_to_route('admin.lider',$title = 'Cancelar',[],['class' => 'btn btn-default']) !!}
    </div>
</div>