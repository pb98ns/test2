@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

@endsection
@section('content')



@if(is_null($today2))
<?php
$today2 = date('Y-m-01');
?>
@endif

@if(is_null($today3))
<?php
$today3 = date('Y-m-d');
?>
@endif



<div class="container ">

    <div class="row justify-content-center">
      
  <center>
 <h3>    <div class="card-header">{{ __('Raport okresowy od') }}  {{$today2}} do {{$today3}} </div> </h3>
 </center>

<div class="col-md-8 ">

<form action="{{action('ProjectController@searchperiod')}}" method="POST" role="form">
@csrf

    <div class="form-row d-flex flex-grow-1 justify-content-center align-items-center">

        <div class="form-group col-md-3 ">
            <label for="inputCity" class="form-row d-flex flex-grow-1 justify-content-center align-items-center">Data początkowa</label>
            <input type="date" class="form-control"name="start_date" id="start_date">
            <br>
            <label for="inputCity" class="form-row d-flex flex-grow-1 justify-content-center align-items-center">Data końcowa</label>
            <input type="date" class="form-control"name="end_date" id="end_date">
        <br>


 
 
            <div class="form-group">
 <center>
 <button type = "submit" class="btn btn-primary">Szukaj</button>

 </center>
 </div>

  
</form>
</div>
</div>




  
      
         

<table class="table" >



  <thead>

    <tr>

    <th scope="col" class="col-7 table-secondary">Użytkownik</th>
    <th scope="col" class=" col-1 table-secondary">Czas</th>
      
     

    </tr>
  </thead>
  <tbody>

  @foreach($all as $projects) 
  
    <tr>

    <td class="table-success table-row" data-href="{{action('ProjectController@show4', $projects['id']) }}" >{{$projects->user->surname}} {{$projects->user->name}}</td>  


<td class="table-success table-row" data-href="{{action('ProjectController@show4', $projects['id']) }}">{{$projects->czas}}</td>  
</tr>

    @endforeach
   
    @foreach($all2 as $projects) 
  
<tr>
<td class="table-danger">{{$projects->user->surname}} {{$projects->user->name}}</td> 
<td class="table-danger"> 00:00:00 </td>  
</tr>
@endforeach
 
  @foreach($suma as $projects)
  
  <td class="table-secondary"><b>SUMA</b></td> 
  <td class="table-secondary"><b>{{$projects->czas3 ? $projects->czas3 : '00:00:00'}}</b></td>
    @endforeach
</tbody>
</table>



<br>

<table class="table" >


  <thead >
    <tr>
    
    <th scope="col" class=" col-7 table-secondary">Klient</th>
    <th scope="col" class="col-1 table-secondary">Czas</th>
      
     

    </tr>
  </thead>
  <tbody>

  @foreach($allfirm as $projects) 
  
<tr>
<td class="table-success table-row" data-href="{{action('ProjectController@show5', $projects['id']) }}">{{$projects->firm->name}}</td>  
<td class="table-success table-row" data-href="{{action('ProjectController@show5', $projects['id']) }}">{{$projects->czas2}}</td>  
</tr>

    @endforeach

    @foreach($allfirm2 as $projects) 
  
  <tr>
<td class="table-danger">{{$projects->firm->name}}</td> 
<td class="table-danger"> 00:00:00 </td>  

</tr>
  @endforeach
  @foreach($suma as $projects)
  
  <td class="table-secondary"><b>SUMA</b></td> 
  <td class="table-secondary"><b>{{$projects->czas3 ? $projects->czas3 : '00:00:00'}}</b></td>
    @endforeach
</tbody>
</table>
</div>
</div>

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endpush
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable2').DataTable();
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
