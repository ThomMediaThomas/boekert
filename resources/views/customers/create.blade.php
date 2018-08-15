@extends('layouts.app')
@section('content')
    <h2>Nieuwe klant</h2>
    <form method="POST" action="{{url('customers')}}" id="create-customer">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-content">
                <?php echo View::make('customers/elements/form'); ?>
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
@stop
