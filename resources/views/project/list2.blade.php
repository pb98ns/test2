@extends('layouts.app')
@section('content')


<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">

 <center>
 <h4> <div class="card-header"><b>{{$project->user->surname}} {{$project->user->name}} - {{ __('szczegóły raportu z dnia') }}  {{ \Carbon\Carbon::parse($project->date)->format('Y-m-d') }}</b></div> </h4>
  </center>
 <div class="card-body">

<label for="user_id"><b>Nazwisko i Imię: </b></label>

 {{$project->user->surname}} {{$project->user->name}} 

</div>


<div class="card-body">
<label for="firm_id"><b>Klient: </b></label>

 {{$project->firm->name}}

</div>



<div class="card-body">
<label for="task_id"><b>Projekt: </b></label>

 {{$project->task->name}}

</div>

@if(!empty($project->description))

<div class="card-body">
<label for="description"><b>Opis: </b></label>

 {{$project->description}}

</div>
@endif

<div class="card-body">
<label for="date"><b>Data:</b></label>
{{$project->date}}
</div>

<div class="card-body">
<label for="time"><b>Czas:</b></label>
{{ \Carbon\Carbon::parse($project->time)->format('H:i') }}
</div>


<br>

<script>
function goBack() {
  window.history.back();
}
</script>


<div class="form-group">
<center>
<button onclick="goBack()"class="btn btn-primary">Zamknij</button>
</center>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
</div>


@endsection