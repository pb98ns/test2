<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>


 <center>
 <h3> <div class="card-header">{{ __('Raport') }}</div> </h3>
  </center>
 <div class="card-body">

<label for="user_id"><b>Nazwisko i Imię:</b></label>
<div class="input-group">
{{$project->user->surname}} {{$project->user->name}} 
</div>
</div>


<div class="card-body">
<label for="firm_id"><b>Klient:</b></label>
<div class="input-group">
{{$project->firm->name}}
</div>
</div>



<div class="card-body">
<label for="task_id"><b>Projekt:</b></label>
<div class="input-group">
{{$project->task->name}}
</div>
</div>

<div class="card-body">
<label for="description"><b>Opis:</b></label>
<div class="input-group">
{{$project->description}}
</div>
</div>


<div class="card-body">
<label for="date"><b>Data:</b></label>
{{$project->date}}
</div>

<div class="card-body">
<label for="time"><b>Czas:</b></label>
{{ \Carbon\Carbon::parse($project->time)->format('H:i') }}
</div>


<br>




<div class="form-group">
<center>
<a href="{{url()->previous()}}" type="button" class="btn btn-primary">Zamknij</a>
</center>
</div>

</form>

</div>
</div>
    
</div>
                </div>
            </div>
        </div>
    </div>