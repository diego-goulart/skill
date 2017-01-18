<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <a href="{{route('admin.permissions.index')}}"
       class="btn btn-default">
        Cancelar</a>

    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
</div>