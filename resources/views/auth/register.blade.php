@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
       
           
                <center>
            <h3>    <div class="card-header">{{ __('Rejestracja użytkownika') }}</div> </h3>
                 </center>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię:') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko:') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres e-mail:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź hasło:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="permissions" class="col-md-4 col-form-label text-md-right">{{ __('Uprawnienia:') }}</label>

                            <div class="col-md-6">
                            <input type="radio" name="permissions" value="Administrator"> Administrator <br/>
                            <input type="radio" name="permissions" value="Użytkownik" checked> Użytkownik <br/>
                                @error('permissions')
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
                                    {{ __('Zarejestruj pracownika') }}
</center>
                                </button>
                            </div>
                        </div>
                    </form>
                
            
       
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __('Lista użytkowników') }}</div> </h3>
                 </center>
                 <table class="table" id="registerTable">
  <thead>
    <tr>
    
      <th scope="col">Nazwisko i Imię</th>
      <th scope="col">Adres email</th>
      <th scope="col">Uprawnienia</th>
      <th scope="col"></th>
      <th scope="col"></th>
      

    </tr>
  </thead>
  <tbody>
  @foreach($pracownicylist as $pracownicy) 
    <tr>
      
      <td><b>{{ $loop->iteration }}. {{$pracownicy['surname']}} {{$pracownicy['name']}}</b></td>
      
      <td>{{$pracownicy['email']}}</td>
     
      <td>{{$pracownicy['permissions']}}</td>
  

      <td><a href="{{URL::to('/home/users/edit/'.$pracownicy->id)}}" class="btn btn-primary a-btn-slide-text" title="Edytuj">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>

    <td>
      <form method = "post" class="delete_from" action="{{action('UserController@delete',$pracownicy['id'] )}}" title="Usuń">
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
if(confirm("Czy na pewno chcesz usunąć zaznaczonego użytkownika?"))
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
    $('#registerTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba użytkowników: _TOTAL_",
      emptyTable: "Brak zdefiniowanych użytkowników",
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
           


