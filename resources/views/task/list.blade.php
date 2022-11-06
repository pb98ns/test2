@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
@if ($message = Session::get('success'))
<div class = "alert alert-success">
<p>{{$message}}</p>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
                <center>
            <h3>    <div class="card-header">{{ __('Rejestracja projektu') }}</div> </h3>
                 </center>
                <div class="card-body">
<form action="{{action('TaskController@store')}}" method="POST" role="form">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa:') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    

                             
<br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                
     

                            </div>
                            <button type="submit" class="btn btn-success">
                                <center>
                                    {{ __('Zarejestruj projekt') }}
</center>
                                </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __('Lista projektów') }}</div> </h3>
                 </center>
           
<table class="table" id="taskTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwa</th>
      <th scope="col"></th>
      <th scope="col"></th>



    </tr>
  </thead>
  <tbody>
  @foreach($tasklist as $tasks) 

        
    <tr>
     
      <td><b>{{ $loop->iteration }}. {{$tasks['name']}}</b></td>
      <td><a href="{{action('TaskController@edit', $tasks['id']) }}" class="btn btn-primary a-btn-slide-text" title="Edytuj">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>

    <td>
      <form method = "post" class="delete_from" action="{{action('TaskController@delete',$tasks['id'] )}}" title="Usuń">
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
</div>
</div>

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#taskTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba projektów: _TOTAL_",
      emptyTable: "Brak zdefiniowanych projektów",
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

@endsection
