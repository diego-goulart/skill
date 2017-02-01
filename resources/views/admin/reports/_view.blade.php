<div class="form-group">
    <table class="table table-bordered">
        <tbody>
        @foreach($questions as $question)
            @if(!isset($question->total))
                <tr class="{{$question->value < 0 ? 'danger text-danger': ''}}">
                    <td width="20%">{{$question->subject}}</td>
                    <td width="">{{$question->description}}</td>
                    <td width="5%">{{$question->value}}</td>
                    <td width="15%">

                       <b> {{$question->response == 'true'? 'Sim': 'Não'}}</b>
                    </td>
                </tr>@endif
        @endforeach
        </tbody>
    </table>
</div>