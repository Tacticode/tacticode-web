{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
	<script src="/arena-viewer/lib/pixi-3.0.9.js"></script>
	<script src="/arena-viewer/lib/jquery-2.2.0.js"></script>
	<script src="/arena-viewer/script/tacticode.js"></script>
	<script src="/arena-viewer/script/map.js"></script>
	<script src="/arena-viewer/script/projectile.js"></script>
	<script src="/arena-viewer/script/entity.js"></script>
	<script src="/arena-viewer/script/customTexture.js"></script>
	<script src="/arena-viewer/script/fight.js"></script>
	<script src="/arena-viewer/script/cellinformation.js"></script>
	<script src="/arena-viewer/script/overlay.js"></script>
	<script src="/arena-viewer/script/config.js"></script>

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

	    var fight = {
			"map": "sample",
			"entities": [
				{"id": 0, "x": 1, "y": 2, "breed": "orc", "team": 0, "health": 1000},
				{"id": 1, "x": 1, "y": 3, "breed": "orc", "team": 0, "health": 800},
				{"id": 2, "x": 6, "y": 4, "breed": "elf", "team": 1, "health": 600}
			],
			"actions" : [
				{"type": "move", "entity": 1, "x": 2, "y": 3},
				{"type": "move", "entity": 1, "x": 2, "y": 4},
				{"type": "skill", "entity": 0, "skill": "fireball", "x": 6, "y": 4},
				{"type": "heal", "entity": 0, "health": 51},
				{"type": "damage", "entity": 2, "health": 51},

				{"type": "move", "entity": 2, "x": 6, "y": 5},
				{"type": "skill", "entity": 2, "skill": "arrow", "x": 2, "y": 4},
				{"type": "damage", "entity": 1, "health": 179},
				{"type": "heal", "entity": 2, "health": 179},
				
				{"type": "move", "entity": 2, "x": 6, "y": 6},
				{"type": "skill", "entity": 2, "skill": "arrow", "x": 5, "y": 0},
				{"type": "move", "entity": 2, "x": 5, "y": 6},
				{"type": "skill", "entity": 2, "skill": "arrow", "x": 25, "y": 0},
				{"type": "move", "entity": 2, "x": 5, "y": 5},
				{"type": "skill", "entity": 2, "skill": "arrow", "x": 4, "y": 12},
				{"type": "move", "entity": 2, "x": 6, "y": 5},
				{"type": "skill", "entity": 2, "skill": "arrow", "x": -5, "y": 5}
			]
		};

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