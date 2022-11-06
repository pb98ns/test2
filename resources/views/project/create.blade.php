
<!DOCTYPE html>
<html>
<head>
	<title>MPKBUS.pl</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
$(document).ready(function(){
  $("#msg").hide();
  //alert("working");
  $("#btn").click(function(){
    $("#msg").show();
    var id_zadania = $("#id_zadania").val()
    var id_autobusu = $("#id_autobusu").val();
    var id_pracownika = $("#id_pracownika").val();
    var data = $("#data").val();
    var token = $("#token").val();
    
    $.ajax({
      type: "post",
      data: "id_zadania=" + id_zadania + "&id_autobusu=" + id_autobusu + "&id_pracownika=" + id_pracownika + "&data=" + data + "&_token=" + token,
      url: "<?php echo url('/home/harmonogram') ?>",
      success:function(data){
        $("#msg").html("Zadanie zostało zapisane");
        $("#msg").fadeOut(2000);
      },
	  error:function(data){
        $("#msg").html("Zadanie NIE zostało zapisane, sprawdź dane i spróbuj ponownie");
	  }
    });
  });
  var auto_refresh = setInterval(
    function(){
      $('#products').load('<?php echo url('products');?>').fadeIn("slow");
    },100);
$('#cat_id').select2();
});
</script>

<td><a href="{{URL::to('/home')}}"><button type = "submit" style = "float: right" class="btn btn-danger">MPKBUS.pl</button></a></td>


</head>
<body>
<div class="container">

<h2>Planowanie zadań</h2>
<p id="msg" class="alert alert-success"></p>
@if ($errors->any())
<div class = "alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


<input type="hidden" value="{{csrf_token()}}" id="token"/>
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="form-group">
<label for="id_zadania"><b>Zadanie:</b></label>
<select id="id_zadania">
@foreach ($zadania as $zadanie)
<option  value="{{$zadanie->id}}">{{$zadanie->zadanie}}{{$zadanie->zmiana}} ({{$zadanie->czas_rozpoczecia}}-{{$zadanie->czas_zakonczenia}}){{$zadanie->okres}} </option>
@endforeach
</select>
</div>

<div class="form-group">
<label for="id_autobusu"><b>Nr taborowy:</b></label>
<select id="id_autobusu">
@foreach ($autobusy as $autobus)
<option  value="{{$autobus->id}}">{{$autobus->nr_taborowy}} </option>
@endforeach
</select>
</div>

<div class="form-group">
<label for="id_pracownika"><b>Kierowca:</b></label>
<select id="id_pracownika">
@foreach ($kierowcy as $kierowca)
<option  value="{{$kierowca->id}}">{{$kierowca->imie}} {{$kierowca->nazwisko}} </option>
@endforeach
</select>
</div>


<div class="form-group">
<label for="data"><b>Data:</b></label>
<div class='input-group date' id='datepicker'>
		                    <input type='text' class="form-control" id="data" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
                        <input type="submit" value="Zapisz" class="btn btn-primary"  id="btn"/>

</div>

<div class="container" id="products">
</div>





















	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script >
	    $(function () {
	        $('#datepicker').datepicker({
	            format: "yyyy-mm-dd",
	            autoclose: true,
	            todayHighlight: true,
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        autoclose: true,
		        changeMonth: true,
		        changeYear: true,
		        orientation: "button"
	        });
	    });
	</script>
</body>
</html>