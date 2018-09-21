@extends('layouts.app')
@section('content')
    <h4>{{ $booking->boekert_id }} bewerken</h4>
    <form method="POST" action="{{ url("/bookings/{$booking->id}") }}" id="create-booking">
        <input name="_method" type="hidden" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col s8">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">work</i> Gegevens over boeking</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="date_from">Datum van</label>
                                <input id="date_from" type="text"
                                       class="datepicker {{ $errors->has('date_from') ? ' invalid' : '' }}"
                                       name="date_from" value="{{ $booking->date_from }}" required>
                            </div>
                            <div class="input-field col s6">
                                <label for="date_to">Datum tot</label>
                                <input id="date_to" type="text"
                                       class="datepicker {{ $errors->has('date_to') ? ' invalid' : '' }}" name="date_to"
                                       value="{{ $booking->date_to }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="type_id" class="{{ $errors->has('type_id') ? ' invalid' : '' }}" name="type_id" value="{{ $booking->type_id }}" required>
                                    @foreach ($accommodation_types as $accommodation_type)
                                        <option value="{{ $accommodation_type->id }}" <?php if ($booking->type_id == $accommodation_type->id): ?>selected<?php endif; ?>>{{ $accommodation_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="type">Soort</label>
                            </div>
                            <div class="input-field show-on-change-type col s6" id="show-for-1">
                                <select id="chalet_type_id" class="{{ $errors->has('chalet_type_id') ? ' invalid' : '' }}" name="chalet_type_id" value="{{ $booking->chalet_type_id }}">
                                    @foreach ($accommodation_chalet_types as $accommodation_chalet_type)
                                        <option value="{{ $accommodation_chalet_type->id }}" <?php if ($booking->chalet_type_id == $accommodation_chalet_type->id): ?>selected<?php endif; ?>>{{ $accommodation_chalet_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="chalet_type">Type huisje</label>
                            </div>
                            <div class="input-field show-on-change-type col s6" id="show-for-2" style="display: none;">
                                <select id="camping_type_id" class="{{ $errors->has('camping_type_id') ? ' invalid' : '' }}" name="camping_type_id" value="{{ $booking->camping_type_id }}">
                                    @foreach ($accommodation_camping_types as $accommodation_camping_type)
                                        <option value="{{ $accommodation_camping_type->id }}" <?php if ($booking->camping_type_id == $accommodation_camping_type->id): ?>selected<?php endif; ?>>{{ $accommodation_camping_type->name }}</option>
                                    @endforeach
                                </select>
                                <label for="camping_type">Type kampeerplaats</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">hotel</i> Bezetting</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">face</i>
                                <label for="adults">Aantal volwassenen</label>
                                <input id="adults" type="text" class="{{ $errors->has('adults') ? ' invalid' : '' }}" name="adults" value="{{ $booking->adults }}" required>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix">child_care</i>
                                <label for="children">Aantal kinderen</label>
                                <input id="children" type="text" class="{{ $errors->has('children') ? ' invalid' : '' }}" name="children" value="{{ $booking->children }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">extension</i> Extra's</span>
                        <div class="row">
                            @foreach ($extras as $extra)
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">{{ $extra->icon }}</i>
                                    <label for="children">{{ $extra->name }}</label>
                                    <?php $bookingExtra = $booking->extras->where('id', $extra->id)->first();?>
                                    <input id="{{ $extra->system_name }}" type="text" class="{{ $errors->has($extra->system_name) ? ' invalid' : '' }}" name="{{ $extra->system_name }}" value="{{ $bookingExtra ? $bookingExtra->pivot->amount : $extra->default }}" required>
                                </div>
                            @endforeach
                        </div>
                    </diV>
                </div>
                <div class="card pink lighten-4">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">note</i> Interne notities</span>
                        <p class="with-margin"><strong>Opgelet!</strong> De notities die je hier invult zijn <u>niet</u> zichtbaar voor de klant en zijn bedoeld voor interne doeleinden.</p>
                        <div class="row">
                            <div class="col s12 input-field">
                                <label for="notes">Notities</label>
                                <textarea class="materialize-textarea {{ $errors->has('notes') ? ' invalid' : '' }}" id="notes" name="notes">{{ $booking->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">history</i> Wijzigingen</span>
                        <table class="compact" id="changelog">
                            <thead>
                                <tr>
                                    <th>datum</th>
                                    <th>wijziging</th>
                                    <th>gebruiker</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->booking_logs as $key => $log)
                                    <tr>
                                        <td>{{ $log->created_at }}</td>
                                        <td>{!! $log->log !!}</td>
                                        <td>{{ $log->user->username}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s4">
                <div class="card blue">
                    <div class="card-content white-text">
                        <span class="card-title"><i class="material-icons">save</i> Wijzigingen opslaan</span>
                        <p class="with-margin">Je wijzigingen worden <strong>niet</strong> automatisch opgeslagen. Klik hieronder om je wijzigingen op te slaan.</p>
                        <p class="with-margin">
                            <button class="btn teal" type="submit">Wijzigingen opslaan</button>
                        </p>
                        <p class="smaller">
                            Laatste wijziging: {{ $booking->updated_at }}<br />
                            Aangemaakt op: {{ $booking->created_at }}
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">In-/uitchecken</span>
                        <div class="input-field">
                            <div class="switch">
                                <label>
                                    Ingecheckt:
                                    <input type="checkbox" name="checked_in" value="1" <?php if ($booking->checked_in): ?>checked="checked"<?php endif; ?>>
                                    <span class="lever"></span>
                                </label>
                            </div>
                            @if ($booking->checked_in)
                                <span class="small-info"><i class="material-icons">info</i> ingecheckt op {{ $booking->checked_in_at }}</span>
                            @endif
                        </div>
                        <div class="divider"></div>
                        <div class="input-field">
                            <div class="switch">
                                <label>
                                    Uitgecheckt:
                                    <input type="checkbox" name="checked_out" value="1" <?php if ($booking->checked_out): ?>checked="checked"<?php endif; ?>>
                                    <span class="lever"></span>
                                </label>
                            </div>
                            @if ($booking->checked_out)
                                <span class="small-info"><i class="material-icons">info</i> uitgecheckt op {{ $booking->checked_out_at }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card amber lighten-4">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">edit_location</i> Koppelen</span>
                        <p class="with-margin">Hieronder vind je een overzicht van <strong>de beschikbare plaatsen</strong> voor de periode
                            en het type van de boeking.</p>
                        <div class="input-field">
                            <select id="accommodation_id" class="{{ $errors->has('type') ? ' invalid' : '' }}"
                                    name="accommodation_id" value="{{ old('accommodation_id') }}" required>
                                <option value="0">- alles -</option>
                                @foreach ($accommodations as $accommodation)
                                    <option value="{{ $accommodation->id }}"
                                            <?php if ($booking->accommodation_id == $accommodation->id): ?>selected<?php endif; ?>
                                            <?php if (!$accommodation->available): ?>disabled<?php endif; ?>>{{ $accommodation->name }}</option>
                                @endforeach
                            </select>
                            <label for="accommodation_id">Accommodatie</label>
                        </div>
                    </div>
                </div>
                <div class="card orange lighten-2">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">euro_symbol</i> Prijsdetail</span>
                        {!! $price !!}
                    </div>
                </div>
                @if (isset($booking->customer))
                    <div class="card green">
                        <div class="card-content white-text">
                            <span class="card-title"><i class="material-icons">account_box</i> Klantgegevens</span>
                            <strong>
                                <a class="white-text" title="Klantgegevens" href="{{ url("/customers/{$booking->customer->id}/edit") }}">
                                    {{ $booking->customer->firstname }} {{ $booking->customer->lastname }} ({{ $booking->customer->country }})
                                </a>
                            </strong><br />
                            @if ($booking->customer->street || $booking->customer->housenumber)
                                <span>{{ $booking->customer->street }} {{ $booking->customer->housenumber }}</span><br/>
                            @endif
                            @if ($booking->customer->zip || $booking->customer->city || $booking->customer->country)
                                <span>{{ $booking->customer->zip }} {{ $booking->customer->city }} ({{ $booking->customer->country }})</span><br />
                            @endif
                            @if ($booking->customer->phone)
                                <span><i class="material-icons tiny">call</i> {{ $booking->customer->phone }}</span><br />
                            @endif
                            @if ($booking->customer->phone)
                                <span><i class="material-icons tiny">email</i> {{ $booking->customer->email }}</span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><i class="material-icons">play_for_work</i> Bron</span>
                        <label>
                            <input name="source" value="phone" type="radio" <?php if ($booking->source == 'phone'): ?>checked<?php endif; ?> />
                            <span>Telefoon</span>
                        </label><br />
                        <label>
                            <input name="source" value="mail" type="radio" <?php if ($booking->source == 'mail'): ?>checked<?php endif; ?> />
                            <span>E-mail</span>
                        </label><br />
                        <label>
                            <input name="source" value="desk" type="radio" <?php if ($booking->source == 'desk'): ?>checked<?php endif; ?> />
                            <span>Balie</span>
                        </label><br />
                        <label>
                            <input name="source" value="site" type="radio" <?php if ($booking->source == 'site'): ?>checked<?php endif; ?> />
                            <span>Website</span>
                        </label><br />
                        <label>
                            <input name="source" value="other" type="radio" <?php if ($booking->source == 'other'): ?>checked<?php endif; ?> />
                            <span>Anders</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
