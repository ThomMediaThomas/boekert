@extends('layouts.app')
@section('content')
    <h2>Nieuwe boeking aanmaken</h2>
    <form method="POST" action="{{url('bookings')}}">
        {{ csrf_field() }}
        <div class="input-field">
            <label for="boekert_id">E-boekert_id</label>
            <input id="boekert_id" type="text" class="{{ $errors->has('boekert_id') ? ' invalid' : '' }}" name="boekert_id" value="{{ old('boekert_id') }}" required autofocus>
        </div>
        <input type="submit">
    </form>
@stop
