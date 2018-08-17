@extends('layouts.app')
@section('content')
    <h2>Alle accommodaties <a href="{{url('accommodations/create')}}" title="Nieuwe accommodatie maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h2>
    <table class="striped higlight sortable" id="accommodations-table">
        <thead>
            <tr>
                <th></th>
                <th># <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>naam <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>nummer <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>type <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accommodations as $accommodation)
                <tr>
                    <td>
                        <a class="material-icons" href="{{ url("/accommodations/{$accommodation->id}/edit") }}" title="Accommodatie bewerken">create</a>
                    </td>
                    <td>{{ $accommodation->id }}</td>
                    <td>{{ $accommodation->name }}</td>
                    <td>{{ $accommodation->field_number }}</td>
                    <td><strong>{{ $accommodation->type }}</strong> | {{ $accommodation->camping_type }}{{ $accommodation->chalet_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
