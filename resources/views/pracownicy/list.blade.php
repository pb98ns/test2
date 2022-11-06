@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
<td><a href="{{URL::to('/register')}}"><button type = "submit" class="btn btn-success">Dodaj pracownika</button></a></td>
<table class="table">
  <thead>
    <tr>
    
      <th scope="col">Imię i Nazwisko</th>
      <th scope="col">Telefon</th>
      <th scope="col">Stanowisko</th>
     
      

    </tr>
  </thead>
  <tbody>
  @foreach($pracownicylist as $pracownicy) 
    <tr>
      
      <td><b>{{$pracownicy['imie']}} {{$pracownicy['nazwisko']}}</b></td>
      
      <td>{{$pracownicy['telefon']}}</td>
     
      <td>{{$pracownicy['stanowisko']}}</td>
      <td><a href="{{URL::to('/home/pracownicy/'.$pracownicy->id)}}"><button type = "submit" class="btn btn-secondary">Zobacz szczegółowe informacje</button></a></td>
      <td><a href="{{URL::to('/home/pracownicy/edit/'.$pracownicy->id)}}" ><button type = "submit" class="btn btn-primary">Edytuj </button></a></td>
      <td>
      <form method = "post" class="delete_from" action="{{action('PracownicyController@delete',$pracownicy['id'] )}}">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger">Usuń</button>
      </form>
      </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
