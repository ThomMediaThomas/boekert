@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s4">
            <div class="card small">
                <div class="card-content">
                    <span class="card-title"><i class="material-icons">near_me</i> Snel naar</span>
                    <p class="with-margin">Hieronder een quick-menu naar verschillende veelgebruike pagina's.</p>
                    <ul class="button-list">
                        <li><a class="btn green" href="{{url('bookings/create')}}" title="Nieuwe boeking maken"><i class="material-icons left">add</i> Nieuwe boeking maken</a></li>
                        <li><a class="btn" href="{{url('calendar')}}" title="Kalender"><i class="material-icons left">date_range</i> Kalender</a></li>
                        <li><a class="btn" href="{{url('customers')}}" title="Klanten"><i class="material-icons left">contacts</i> Klanten</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col s8">
            <?php echo View::make('home/elements/latest', ['bookings' => $latestBookings]); ?>
        </div>
        <div class="col s6">
            <?php echo View::make('home/elements/arrivals', ['bookings' => $bookingsArrivingToday]); ?>
        </div>
        <div class="col s6">
            <?php echo View::make('home/elements/departures', ['bookings' => $bookingsLeavingToday]); ?>
        </div>
        <div class="col s12">
            <?php echo View::make('home/elements/unattached', ['bookings' => $bookingsUnattached]); ?>
        </div>

    </div>
@stop
