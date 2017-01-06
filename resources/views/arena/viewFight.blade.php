{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
	<script src="/arena-viewer/lib/pixi-3.0.9.js"></script>
	<!--<script src="/arena-viewer/lib/jquery-2.2.0.js"></script>-->
	<script src="/arena-viewer/script/arena-viewer.js?ver=2017-01-02"></script>>
	<script src="/arena-viewer/script/config.js"></script>>
@endsection

@section('content')
    <h1 class="page-header">@lang('arena.fight')</h1>

    @if (!$fight['fight_content'])
    	
    	{{$fight['id']}}
    	<input id="fightId" name="fightId" value="{{$fight['id']}}" type="hidden">
    
	    <div class="row arena">
			<div class="row">
				@if ($fight['characters'][0]['team_id'])
					<div class="col-md-5">
						@foreach ($fight['characters'] as $characters)
							@if ($characters['team_id'] == $fight['characters'][0]['team_id'])
								{{$characters['name']}}
							@endif
						@endforeach
					</div>
					<div class="col-md-2">
						VS
					</div>
					<div class="col-md-5">
						@foreach ($fight['characters'] as $characters)
							@if ($characters['team_id'] != $fight['characters'][0]['team_id'])
								{{$characters['name']}}
							@endif
						@endforeach
					</div>
				@else
					<div class="col-xs-5 col-md-2 fight-character">
						{{$fight['characters'][0]['name']}}
					</div>
					<div class="col-xs-2 col-md-1 fight-character">
						VS
					</div>
					<div class="col-xs-5 col-md-2 fight-character">
						{{$fight['characters'][1]['name']}}
					</div>
				@endif
			</div>
			<div class="row">
			</div>
	    </div>

	@else

		<div class="row">
			<input id="fightId" name="fightId" value="{{$fight['id']}}" type="hidden">
			<input id="fightContent" name="fightContent" value="{{$fight['fight_content']}}" type="hidden">
		</div>

    @endif

    <div id="viewer"></div>

    <script>

    	var fightId = null;

    	function checkSample(fight) {

		    if (fight.map === undefined)
	    		fight.map = "sample";
	    	if (fight.actions === undefined)
	    		fight.actions = [];
	    	if (fight.entities === undefined)
	    		fight.entities = [];
    	}

    	function askFightContent() {

    		$.getJSON('/arena/contentfight/' + fightId, function(data) {
    			
	    		if (!data.content)
		    		setTimeout(askFightContent, 1000);
		    	else {

		    		checkSample(data.content);
				    Tacticode.init("viewer");
					Tacticode.loadFight(data.content);
		    	}
    		});
    	}

    	$(document).ready(function() {

    		fightId = $('#fightId').val();
    		fightContent = $('#fightContent').val();
    		$('#fightId').remove();
    		
    		if (fightId)
    			askFightContent();
    	});

    </script>
@endsection