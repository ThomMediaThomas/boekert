@extends('layouts.app')
@section('content')
    <h2>Alle accommodaties <a href="{{url('accommodations/create')}}" title="Nieuwe accommodatie maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h2>


    <table class="striped higlight" id="accommodations-table">
        <thead>
            <tr>
                <th>#</th>
                <th>naam</th>
                <th>nummer</th>
                <th>type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accommodations as $accommodation)
                <tr>
                    <td>{{ $accommodation->id }}</td>
                    <td>{{ $accommodation->name }}</td>
                    <td>{{ $accommodation->field_number }}</td>
                    <td><strong>{{ $accommodation->type }}</strong> | {{ $accommodation->camping_type }}{{ $accommodation->chalet_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
