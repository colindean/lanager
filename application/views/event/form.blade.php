@layout('layouts/default')
@section('content')

<?php
// prepare form data

// add empty dropdown items to optional fields
$event_types = array_merge(array(NULL => NULL),$event_types );
$managers = array_merge(array(NULL => NULL),$managers );

?>

<h3>New Event</h3>
@if(Session::has('errors'))
	@foreach(Session::get('errors') as $error)
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert" href="#">x</a>
			<strong>Error: </strong>{{$error}}
		</div>
	@endforeach
@endif

{{ Form::open('events/create') }}
{{ Form::token() }}
{{ Form::label('name', 'Name') }}
{{ Form::text('name',NULL,array('placeholder' => 'e.g. Team Fortress 2', 'maxlength' => 200)) }}
<br>
{{ Form::label('description', 'Description') }}
{{ Form::textarea('description',NULL,array('placeholder' => 'Add more info. Markdown allowed.', 'rows' => 4)) }}
<br>
{{ Form::label('start', 'Starts') }}
<div id="start_datetimepicker" class="input-append date">
    <input name="start" id="start" data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
</div>
{{ Form::label('end', 'Ends') }}
<div id="end_datetimepicker" class="input-append date">
    <input name="end" id="end" data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
</div>


<script type="text/javascript">
  // initialise start & end datepickers
  $(function() {
    $('#start_datetimepicker').datetimepicker({
      language: 'en'
    });
    $('#end_datetimepicker').datetimepicker({
      language: 'en'
    });
  });
  // populate "end" field when a "start" is chosen
  $('#start_datetimepicker').datetimepicker().on('hide', function(ev){
  	if(typeof endPopulatedFromStart == 'undefined')
  	{
  		$('#end_datetimepicker').datetimepicker('setValue', $("#start").val());
  		endPopulatedFromStart = true;
  	}
  });
</script>



{{ Form::label('type', 'Type') }}
{{ Form::select('type', $event_types) }}
<br>
{{ Form::label('manager', 'Manager') }}
{{ Form::select('manager', $managers) }}
<br>
<br>
{{ Form::submit('Create') }}

{{ Form::close() }}
@endsection