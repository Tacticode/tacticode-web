{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('arena.soloFight')</h1>

    @if (!$fight['fight_content'])
    	
    	<input id="fightId" name="fightId" value="{{$fight['id']}}" type="hidden">
    
	    <div class="row arena">
			@if ($fight['characters'][0]['team_id'])
				Combat team
			@else
				<div class="row">
					<div class="col-md-5">
						{{$fight['characters'][0]['name']}}
					</div>
					<div class="col-md-2">
						VS
					</div>
					<div class="col-md-5">
						{{$fight['characters'][1]['name']}}
					</div>
				</div>
				<div class="row">
					Combat en cours...
				</div>
			@endif
	    </div>

	@else

		Combat \o/

    @endif

    <script>

    	var fightId = null;
    	var timeout = null;

    	function askFightContent() {

    		$.getJSON('/arena/contentfight/' + fightId, function(data) {
    			
    			console.log(data);
	    		if (!data.content)
		    		setTimeout(askFightContent, 1000);
    		});
    	}

    	$(document).ready(function() {

    		fightId = $('#fightId').val();
    		$('#fightId').remove();
    		
    		if (fightId)
    			askFightContent();
    	});

    </script>
@endsection