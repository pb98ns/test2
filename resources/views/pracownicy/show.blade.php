@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
<div class="card-header">
{{$pracownicy->imie}} {{$pracownicy->nazwisko}}
</div>
<div class="card-body">
<table class="table">
<tr>
<td>Imię i Nazwisko:</td>
<td><b>{{$pracownicy->imie}} {{$pracownicy->nazwisko}}</b></td>
</tr>
<tr>
<td>Stanowisko:</td>
<td><b>{{$pracownicy->stanowisko}} </b></td>
</tr>
<tr>
<td>Telefon:</td>
<td><b>{{$pracownicy->telefon}} </b></td>
</tr>
<tr>
<td>Adres e-mail:</td>
<td><b>{{$pracownicy->email}}</b> </td>
</tr>
<tr>
<td>Pesel:</td>
<td><b>{{$pracownicy->pesel}} </b></td>
</tr>
<tr>

<td>Kraj:</td>
@foreach ($pracownicy->adres as $address)
<td><b>{{$address->kraj}} </b></td>
@endforeach
</tr>
<tr>
<td>Kod pocztowy:</td>
@foreach ($pracownicy->adres as $address)
<td><b>{{$address->kod_pocztowy}}</b> </td>
@endforeach
</tr>
<tr>
<td>Miejscowość:</td>
@foreach ($pracownicy->adres as $address)
<td><b>{{$address->miasto}}</b> </td>
@endforeach
</tr>


@foreach ($pracownicy->adres as $address)
@if($address->ulica != "")
<tr>
<td>Ulica:</td>
@foreach ($pracownicy->adres as $address)
<td><b>{{$address->ulica}} {{$address->nr_budynku}} </b></td>
@endforeach
</tr>
@endif
@endforeach



@foreach ($pracownicy->adres as $address)
@if($address->nr_lokalu != "")
<tr>
<td>Nr mieszkania:</td>
@foreach ($pracownicy->adres as $address)
<td><b>{{$address->nr_lokalu}}</b></td>
@endforeach
</tr>
@endif
@endforeach





@endsection
