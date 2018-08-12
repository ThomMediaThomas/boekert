
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
    <li><a href="{{url('bookings')}}" title="Boekingen"><i class="material-icons">receipt</i>Boekingen</a></li>
    <li><a href="#!"><i class="material-icons">perm_contact_calendar</i>Kalender</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Beheer</a></li>
    <li><a href="#!"><i class="material-icons">home</i>Accomodaties</a></li>
    <li><a href="#!"><i class="material-icons">contacts</i>Klanten</a></li>
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
