
<ul id="slide-out" class="sidenav sidenav-fixed">
    @if (!Auth::guest())
    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{ URL::asset('files/images/bg-sidebar.jpg') }}">
            </div>
            <a href="/"><img class="responsive-img" src="{{ URL::asset('files/images/logo.png') }}"></a>
            <a href="/"><span class="white-text name">Leuk dat je er weer bent, {{ Auth::user()->name }}!</span></a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="white-text email">Of wil je weer uitloggen?</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
    <li <?php if (Request::is('home')): ?>class="active"<?php endif; ?>>
        <a href="{{url('home')}}" title="Dashboard"><i class="material-icons">dashboard</i>Dashboard</a>
    </li>
    <li <?php if (Request::is('bookings')): ?>class="active"<?php endif; ?>>
        <a href="{{url('bookings')}}" title="Boekingen"><i class="material-icons">receipt</i>Boekingen</a>
    </li>
    <li <?php if (Request::is('calendar')): ?>class="active"<?php endif; ?>>
        <a href="{{url('calendar')}}" title="Kalender"><i class="material-icons">date_range</i>Kalender</a>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <a class="subheader">Beheer</a>
    </li>
    <li <?php if (Request::is('accommodations')): ?>class="active"<?php endif; ?>>
        <a href="{{url('accommodations')}}" title="Accommodaties"><i class="material-icons">home</i>Accommodaties</a>
    </li>
    <li <?php if (Request::is('customers')): ?>class="active"<?php endif; ?>>
        <a href="{{url('customers')}}" title="Klanten"><i class="material-icons">contacts</i>Klanten</a>
    </li>
    @else
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="{{ URL::asset('files/images/bg-sidebar.jpg') }}">
                </div>
                <a href="/"><img class="responsive-img" src="{{ URL::asset('files/images/logo.png') }}"></a>
            </div>
        </li>
    @endif
</ul>
<a href="#" id="collapse-sidebar" class="btn-floating" title="Sidebar in-/uitklappen"><i class="material-icons close">chevron_left</i><i class="material-icons open">chevron_right</i></a>
