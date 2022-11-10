@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pl.min.js"></script>
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
@endsection


@section('content')
<?php
$dateshow = date('Y-m-d');
?>

@if(is_null($today))
<?php
$today = date('Y-m-d');
?>
@endif


<div class="container">
    <div class="row justify-content-center">
    <center>
 <h3>    <div class="card-header"> {{ Auth::user()->name }}  {{ Auth::user()->surname }}
 
<h3> {{$today}} ({{ \Carbon\Carbon::parse($today)->translatedFormat('l') }}) </h3> @if(!empty($showsum))
@foreach($showsum as $projects) 

<h3>
Czas pracy:
{{$projects->czas ? \Carbon\Carbon::parse($projects->czas)->format('H:i') : '00:00'}}
</h3>
@endforeach

@endif</div> 
 </center>
        <div class="col-md-8">
            <form action="{{action('HomeController@searchday2')}}" method="POST" role="form">
@csrf

    <div class="form-row d-flex flex-grow-1 justify-content-center align-items-center">

        <div class="form-group col-md-3 ">
            <label for="inputCity" class="form-row d-flex flex-grow-1 justify-content-center align-items-center">Data</label>
            <input type="date" class="form-control"name="start_date" id="start_date">
        <br>


 
 
            <div class="form-group">
 <center>
 <button type = "submit" class="btn btn-primary">Szukaj</button>

 </center>
 </div>

  
</form>
</div>
</div>

        </div>
    </div>









@if($today === $dateshow)
<div class="container">
    <div class="row justify-content-center">
            
                <div class="card-body">
<form action="{{action('HomeController@store')}}" method="POST" role="form">
<input type="hidden" name="_token" value="{{csrf_token()}}" />


<input type="hidden" class="form-control" name="user_id"  value="{{Auth::user()->id}}"/>



<div class="form-group col-md-6">
<input id="firm_id" type="hidden" class="form-control @error('firm_id') is-invalid @enderror" name="firm_id" value="{{ old('firm_id') }}" required autocomplete="firm_id" autofocus>
<label for="firm_id"><b>Klient:</b></label>

@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <select name="firm_id" class="form-select form-select-lg mb-3 @error('firm_id') is-invalid @enderror" id="firm_id" required autocomplete="firm_id" autofocus >
<option value="" selected disabled hidden></option>

@foreach ($firm as $company)
<option name="firm_id" value="{{$company->id}}">{{$company->name}} </option>
@endforeach
</select>
</div>





<div class="form-group col-md-6">
<input id="task_id" type="hidden" class="form-control @error('task_id') is-invalid @enderror" name="task_id" value="{{ old('task_id') }}" required autocomplete="task_id" autofocus>
<label for="task_id"><b>Projekt:</b></label>

@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <select name="task_id" class="form-select form-select-lg mb-3 @error('task_id') is-invalid @enderror" id="task_id" required autocomplete="task_id" autofocus >
<option value="" selected disabled hidden></option>

@foreach ($task as $zadanie)
<option name="task_id" value="{{$zadanie->id}}">{{$zadanie->name}} </option>
@endforeach
</select>
</div>


<div class="form-group col-md-6">
<label for="time"><b>Czas:</b></label>
<input id="time" type="text" class="timepicker form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" autofocus>

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
  
</div> 



<div class="form-group col-md-6">
<label for="description"><b>Opis:</b></label>

<div class="input-group">
<div class="input-group-prepend">
  </div>
  <textarea rows="1" class="form-control" style="webkit-border-radius: 5px; moz-border-radius: 5px; border-radius: 5px;" id="textarea" name="description" aria-label="With textarea"></textarea>
</div>
</div>  
      
               
<input type="hidden" class="form-control" name="date"  value="{{$today}}"/>                   
              
<br>
                       


                        

                        <div class="form-group row mb-0">
                        
                        <input type="submit" value="Dodaj raport" class="btn btn-success" />
                       
                        </form>
                        </div>
                </div>
    </div>


  @endif
<table class="table" id="myTable" data-show-footer="true">
  <thead>
    <tr>
    
    <th scope="col">Klient</th>
    <th scope="col">Projekt</th>
    <th scope="col">Opis</th>
    <th scope="col">Czas</th>
   
     

    </tr>
  </thead>
  <tbody>
  @foreach($showuserproject as $projects) 
    <tr>
<td class="table-row" >{{ $loop->iteration }}. {{$projects->firm->name}}</td> 
<td class="table-row" >{{$projects->task->name}}</td>  
<td class="table-row" >{{$projects['description']}}</td>   
<td class="table-row" >{{ \Carbon\Carbon::parse($projects->time)->format('H:i') }}</td>  

    </tr>
    @endforeach
</tbody>
</table>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Raport czasu pracy z dnia {{$today}} ",
      emptyTable: "Brak zdefiniowanych raportów w dniu {{$today}}",
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




<script>
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

</script>
</script>
<script type="text/javascript">
    $('.date').datepicker({  
      
      format: 'yyyy-mm-dd',
      language: 'pl'
      
     });  
  
</script> 
<script type="text/javascript">

    $('.timepicker').datetimepicker({

        format: 'HH:mm'

    }); 

</script>


@endsection
