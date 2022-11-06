@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
@if(is_null($today2))
<?php
$today2 = date('Y-01-01');
?>
@endif

@if(is_null($today3))
<?php
$today3 = date('Y-12-31');
?>
@endif
<div class="container">
@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="row justify-content-center">
      
  <center>
 <h3>    <div class="card-header">{{ __('Urlop') }}</div> </h3>
 </center>

<div class="col-md-12">

<form action="{{action('VacationController@store')}}" method="POST" role="form">
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
        <label for="system">System pracy:</label>

        <div class="form-row">
        <div class="form-check form-check-inline">
  <input name="system"  type="radio" id="inlineCheckbox1" value="1" checked>
  <label class="form-check-label" name="system" value="1" for="inlineCheckbox1">1 - 5</label>
</div>
<div class="form-check form-check-inline">
  <input name="system"  type="radio" id="inlineCheckbox2" value="2">
  <label class="form-check-label" name="system" value="2" for="inlineCheckbox2">1 - 6</label>
</div>
<div class="form-check form-check-inline">
  <input name="system"  type="radio" id="inlineCheckbox3" value="3">
  <label class="form-check-label" name="system" value="3" for="inlineCheckbox3">1 - 7</label>
</div>
                                @error('system')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
</div>
</div>

<div class="form-group col-md-4">
        <label for="type_vacation">Typ urlopu:</label>

        <div class="form-row">
        <div class="form-check form-check-inline">
  <input name="type_vacation"  type="radio" id="inlineCheckboxtype" value="UW" checked>
  <label class="form-check-label" name="type_vacation" value="UW" for="inlineCheckboxtype">Wypoczynkowy</label>
</div>
<div class="form-check form-check-inline">
  <input name="type_vacation"  type="radio" id="inlineCheckboxtype2" value="CH">
  <label class="form-check-label" name="type_vacation" value="CH" for="inlineCheckboxtype2">Chorobowy</label>
</div>

                                @error('type_vacation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
</div>
</div>

</div>


</div>


<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                
     

                            </div>
                            <button type="submit" class="btn btn-success">
                                <center>
                                    {{ __('Zgłoś urlop') }}
</center>
                                </button>
                                
                        </div>
  
</form>







<div class="form-group col-md-6"  style="margin-top: 30px;">
    <div class="row justify-content-center">
    <div class="form-row">
     <form action="{{action('VacationController@searchvacation')}}" method="POST" role="form">
     @csrf
<div class="form-group col-md-4">
    <label for="inputCity">Data początkowa:</label>
    <input type="date" class="form-control" name="start_date2" id="start_date2" >
</div>

<div class="form-group col-md-4">
    <label for="inputZip">Data końcowa:</label>
    <input type="date" class="form-control" name="end_date2" id="end_date2">
</div>


 
<div class="text-center">
 <center>
    <br>
 <button type = "submit" class="btn btn-primary">Filtruj</button>

 </center>
 <br>
 </div>
</form>
</div>
         
                <center>
            <h3>    <div class="card-header">{{ __('Zgłoszone dni urlopu wypoczynkowego') }} 



({{$vacations->count()}})



<br> {{$today2}} - {{$today3}}</div> </h3>
                 </center>
                 
<table class="table" id="taskTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i Imię:</th>
      <th scope="col">Data urlopu:</th>
     



    </tr>
  </thead>
  <tbody>
  @foreach($vacations as $vac) 

        
    <tr>
     
      <td><b>{{ $loop->iteration }}. {{$vac->user->surname}} {{$vac->user->name}}</b></td>
      <td><b>{{$vac['vacation_date']}}  ({{ \Carbon\Carbon::parse($vac['vacation_date'])->translatedFormat('l') }})</b></td>

  
    </tr>


    @endforeach
</tbody>
</table>
<script>
$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczony projekt?"))
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


      
         
                <center>
            <h3>    <div class="card-header">{{ __('Zgłoszone dni urlopu chorobowego') }} 



({{$vacations_ch->count()}})



<br> {{$today2}} - {{$today3}}</div> </h3>
                 </center>
                 





<table class="table" id="CHTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i Imię:</th>
      <th scope="col">Data urlopu:</th>
     



    </tr>
  </thead>
  <tbody>
  @foreach($vacations_ch as $vac) 

        
    <tr>
     
      <td><b>{{ $loop->iteration }}. {{$vac->user->surname}} {{$vac->user->name}}</b></td>
      <td><b>{{$vac['vacation_date']}}  ({{ \Carbon\Carbon::parse($vac['vacation_date'])->translatedFormat('l') }})</b></td>

  
    </tr>


    @endforeach
</tbody>
</table>
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#taskTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba zgłoszonych dni urlopu wypoczynkowego : _TOTAL_",
      emptyTable: "Brak zdefiniowanych urlopów wypoczynkowych",
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
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#CHTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba zgłoszonych dni urlopu chorobowego : _TOTAL_",
      emptyTable: "Brak zdefiniowanych urlopów chorobowych",
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
</div>

@endsection
