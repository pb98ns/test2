@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
            <h3>    <div class="card-header">{{ __('Edytuj dane klienta') }}</div> </h3>
                 </center>
                <div class="card-body">
                @if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
@endif
<form method="post" action = "{{action('FirmController@update', $id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa:') }}</label>

                            <div class="col-md-6">
                         
<input type = "text" name="name" class="form-control" value="{{$firm->name}}" placeholder = "Uzupełnij nazwę klienta" />

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    


                        <div class="form-group row">
                            <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Adres:') }}</label>

                            <div class="col-md-6">
                            <input type = "text" name="place" class="form-control" value="{{$firm->place}}" placeholder = "Uzupełnij adres klienta" />

                                @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('Nip:') }}</label>

                            <div class="col-md-6">
                            <input type = "text" name="nip" class="form-control" value="{{$firm->nip}}" placeholder = "Uzupełnij numer Nip" />

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                  
<br>
                        <div class="form-group row mb-0">
                        <div class = "form-group">
                        <center>
<input type = "submit" class="btn btn-primary" value="Zapisz zmiany" />
<a href="{{url()->previous()}}" type="button" class="btn btn-danger">Anuluj</a>
</center>
</div>

</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection