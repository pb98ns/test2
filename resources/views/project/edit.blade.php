@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pl.min.js"></script>

  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  

</head>
  
<body>
   
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
         <div class="card">
         <center>
            <h3>    <div class="card-header">{{ __('Edytuj raport') }}</div> </h3>
                 </center>
                <div class="card-body">


<form method="post" action = "{{action('ProjectController@update', $id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />

<div class="form-group">
<input type="hidden" name='user_id'>
<label for="user_id"><b>Nazwisko i Imię:</b></label>
<select class="form-select form-select-lg mb-2" name="user_id"  >
@foreach ($user as $uzytkownik)
<option name="user_id" 
value="{{$uzytkownik->id}}" 
@if ($uzytkownik->id === $project->user_id)
selected
@endif
>
{{$uzytkownik->surname}} {{$uzytkownik->name}}
</option>
@endforeach
</select>
 

</div>
<div class="form-group">
<input type="hidden" name='firm_id'>
<label for="firm_id"><b>Klient:</b></label>
<select class="form-select form-select-lg mb-2" name="firm_id"  >
 name="firm_id"  >
@foreach ($firm as $firms)
<option name="firm_id" 
value="{{$firms->id}}"
@if ($firms->id === $project->firm_id)
selected
@endif
>
{{$firms->name}}
</option>
@endforeach
</select>
 

</div>
<div class="form-group">
<label for="task_id"><b>Projekt:</b></label>
<select class="form-select form-select-lg mb-2" name="task_id"  >
name="task_id"   >
@foreach ($task as $tasks)
<option name="task_id" 
value="{{$tasks->id}}"
@if ($tasks->id === $project->task_id)
selected
@endif
>
{{$tasks->name}}
</option>
@endforeach
</select>

</div>
<div class="form-group">
<label for="description"><b>Opis:</b></label>

<div class="input-group">
  <div class="input-group-prepend">
  </div>
  <textarea class="form-control" name="description" aria-label="With textarea">{{$project->description}}</textarea>
</div>
</div>

<div class = "row">
<div class="col">
<label for="date"><b>Data:</b></label>
<input type = "text" class="date form-control" name="date"  value="{{$project->date}}"  />
</div>
<div class="col">
<label for="time"><b>Czas:</b></label>
<input type = "text" class='timepicker form-control' name="time"  value="{{ \Carbon\Carbon::parse($project->time)->format('H:i') }}"  />


</div>
</div>
<br>




<div class="form-group">
<center>
<input type = "submit" class="btn btn-primary" value="Zapisz zmiany" />
<a href="{{url()->previous()}}" type="button" class="btn btn-danger">Anuluj</a>
</center>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
</div>


  
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


</body>
  
</html>
@endsection