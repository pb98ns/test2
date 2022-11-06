@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')


<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">

 <center>
 <h4> <div class="card-header"><b> <h4>@foreach($vacations2 as $projects2)<b>{{$projects2->user->surname}} {{$projects2->user->name}} </b>@endforeach</h4> Urlop chorobowy za okres {{ \Carbon\Carbon::parse($variable6)->format('Y-m-d') }} - {{ \Carbon\Carbon::parse($variable7)->format('Y-m-d') }}
 @foreach($vacations_count as $vac)
 <h4> 
 <b>Liczba dni urlopu chorobowego: {{$vac->czas}}</b>
</h4>
@endforeach
 </b>
</h4></div>
  </center>
 <div class="card-body">





 <table class="table" id="myTable">
  <thead>
    <tr>
    
    <th scope="col">Użytkownik</th>
      <th scope="col">Data</th>
      <th scope="col">Typ</th>
      <th scope="col"></th>
      
     

    </tr>
  </thead>
  <tbody>
  @foreach($vacations as $projects) 
    <tr>

<td>{{$projects->user->surname}} {{$projects->user->name}} </td>   
<td>{{$projects->vacation_date}} ({{ \Carbon\Carbon::parse($projects->vacation_date)->translatedFormat('l') }})</td>  
<td>{{$projects->type_vacation}}</td>  
<td>
      <form method = "post" class="delete_from" action="{{action('VacationController@delete',$projects['id'] )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="bi bi-trash"></span></button>
      </form>
</td>  
    </tr>
@endforeach
</tbody>
</table>



<br>

<script>

$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczony raport chorobowy?"))
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