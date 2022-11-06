@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
<div class="container">

    <div class="row justify-content-center">
      
  <center>
 <h3>    <div class="card-header">{{ __('Lista raportów') }}</div> </h3>
 </center>

<div class="col-md-12">

<form action="{{action('ProjectController@search')}}" method="POST" role="form">
@csrf

    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="inputCity">Data początkowa:</label>
            <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : '' ?>" >
        </div>

        <div class="form-group col-md-4">
            <label for="inputZip">Data końcowa:</label>
            <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : '' ?>">
        </div>









       











        <div class="form-group col-md-4">
<input type="hidden" name='user_id'>
<label for="user_id"><b>Użytkownik:</b></label>
<select class="form-select form-select-lg mb-2" id="user_id" name="user_id" id="myDropdown"  >
<option value="" selected disabled hidden></option>
@foreach ($user as $uzytkownik)




<option name="user_id" 
value="{{$uzytkownik->id}}" >

{{$uzytkownik->surname}} {{$uzytkownik->name}}
</option>
@endforeach
</select>
</div>



























<div class="form-group col-md-4">
<input type="hidden" name='task_id'>
<label for="task_id"><b>Projekt:</b></label>
<select class="form-select form-select-lg mb-2" id="task_id" name="task_id" id="myDropdown" >
<option value="" selected disabled hidden></option>
@foreach ($task as $zadanie)
<option name="task_id" 
value="{{$zadanie->id}}">

{{$zadanie->name}}
</option>
@endforeach
</select>
</div>



<div class="form-group col-md-4">
<input type="hidden" name='firm_id'>
<label for="firm_id"><b>Klient:</b></label>
<select class="form-select form-select-lg mb-2" id="firm_id" name="firm_id" id="myDropdown" >
<option value="" selected disabled hidden></option>
@foreach ($firm as $klient)
<option name="firm_id" 
value="{{$klient->id}}">

{{$klient->name}}
</option>
@endforeach
</select>
</div>

<div class="form-group col-md-4">
<label for="date"><b>Czas:</b></label>
@if(!empty($all10))
@foreach($all10 as $projects) 

<h4> <div class="input-group">
{{ $projects->czas10 }}
</div> </h4>
@endforeach

@endif
</div>


</div>

</div>

  <div class="form-group text-center">

 <button type = "submit" class="btn btn-primary text-center">Filtruj</button>

    </div>
  
</form>

<div class="form-group text-center">
 <a href="{{action('ProjectController@index') }}">    <button type = "submit" class="btn btn-secondary text-center">Reset</button></a>
 </div>
</div>

<table class="table" id="myTable" data-show-footer="true">
  <thead>
    <tr>
    
    <th scope="col">Nazwisko i Imię</th>
      <th scope="col">Data</th>
      <th scope="col">Projekt</th>
      <th scope="col">Klient</th>
      <th scope="col">Czas</th>
      <th scope="col"></th>
      <th scope="col"></th>
     

    </tr>
  </thead>
  <tbody>
  @foreach($all as $projects) 
    <tr>
<td class="table-row" data-href="{{action('ProjectController@show', $projects['id']) }}"><b>{{$projects->user->surname}} {{$projects->user->name}}</b></td> 
<td class="table-row" data-href="{{action('ProjectController@show', $projects['id']) }}">{{$projects['date']}}</td>   
<td class="table-row" data-href="{{action('ProjectController@show', $projects['id']) }}">{{$projects->task->name}}</td>  
<td class="table-row" data-href="{{action('ProjectController@show', $projects['id']) }}">{{$projects->firm->name}}</td> 
<td class="table-row" data-href="{{action('ProjectController@show', $projects['id']) }}">{{ \Carbon\Carbon::parse($projects->time)->format('H:i') }}</td>  

    <td><a href="{{action('ProjectController@edit', $projects['id']) }}" class="btn btn-primary a-btn-slide-text" title="Edytuj">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>

    <td>
      <form method = "post" class="delete_from" action="{{action('ProjectController@delete',$projects['id'] )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="bi bi-trash"></span></button>
      </form>
      </td> 
    </tr>
    @endforeach
</tbody>
</table>

    

<script>

$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczony raport?"))
{
return true;
}
else
{
return false;
}
});
});

</script>

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba raportów: _TOTAL_",
      emptyTable: "Brak zdefiniowanych raportów",
      search: "Szukaj:" ,
    
      "paginate": {
      previous: "Poprzednia strona",
      next: "Następna strona"
    }
   
    },
    "oLanguage": {
      sLengthMenu: "Wyświetl _MENU_ rekordów",
    },
      "ordering": false,
      "pageLength": 25

      
    });
} );
</script>
@endpush
@push('scripts')

<script>
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
@endpush
<style>
.table-row{
cursor:pointer;
}
</style>

@endsection
