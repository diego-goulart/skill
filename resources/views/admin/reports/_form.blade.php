@foreach($questions as $question)
    @if(!isset($question->total))
        <row>
            <div class="col col-md-2">
                <b class="text-uppercase">{{$question->subject}}: </b>
            </div>
            <div class="col col-md-8">
                {{$question->description}} -
            </div>
            <div class="col col-md-2">
                {{number($question->value, 0)}}&nbsp;&nbsp;&nbsp;
                <label class="radio-inline">
                    <input type="radio" name="{{$question->id}}" id="eval_{{$question->id}}_true"
                           value="true" {{ $question->response=="true" ? 'checked='.'"'.'checked'.'"' : '' }} required>
                    Sim
                </label>

                <label class="radio-inline">
                    <input type="radio" name="{{$question->id}}" id="eval_{{$question->id}}_false"
                           value="false" {{ $question->response=="false" ? 'checked='.'"'.'checked'.'"' : '' }} required>
                    Não
                </label>

            </div>
        </row><div class="clearfix"></div><hr>
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
        {!! link_to_route('admin.reports.index',$title = 'Cancelar',[],['class' => 'btn btn-default']) !!}
    </div>
</div>