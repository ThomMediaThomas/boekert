@inject('labels', 'App\Services\LabelService')
@extends('layouts.app')
@section('content')
    <h4>Alle accommodaties <a href="{{url('accommodations/create')}}" title="Nieuwe accommodatie maken" class="btn-floating btn-large"><i class="material-icons">add</i></a></h4>

    <?php echo View::make('accommodations/elements/filters', [
            'filter' => $filter,
            'accommodation_types' => $accommodation_types,
            'accommodation_subtypes' => $accommodation_subtypes
    ]); ?>

    <table class="striped higlight sortable compact" id="accommodations-table">
        <thead>
            <tr>
                <th># <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>naam <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th>nummer <i class="up material-icons">arrow_upward</i><i class="down material-icons">arrow_downward</i></th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accommodations as $accommodation)
                <tr>
                    <td>{{ $accommodation->id }}</td>
                    <td>
                        {{ $accommodation->name }}
                        {!!  $labels->getTypeLabel($accommodation) !!}
                    </td>
                    <td>{{ $accommodation->field_number }}</td>
                    <td class="action-cell">
                        <a class="btn-floating small" href="{{ url("/accommodations/{$accommodation->id}/edit") }}" title="Accommodatie bewerken">
                            <i class="material-icons">create</i>
                        </a>
                    </td>
                    <td class="action-cell">
                        <form action="{{ url("/accommodations/{$accommodation->id}") }}" method="POST">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn-floating small red"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
