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