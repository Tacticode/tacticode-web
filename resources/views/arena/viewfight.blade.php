{{--*/ $nav = 'arena' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
	<script src="/arena-viewer/lib/pixi-3.0.9.js"></script>
	<script src="/arena-viewer/lib/jquery-2.2.0.js"></script>
	<script src="/arena-viewer/script/tacticode.js"></script>
	<script src="/arena-viewer/script/map.js"></script>
	<script src="/arena-viewer/script/projectile.js"></script>
	<script src="/arena-viewer/script/entity.js"></script>
	<script src="/arena-viewer/script/fight.js"></script>
	<script src="/arena-viewer/script/viewer.js"></script>
	<script src="/arena-viewer/script/shadowtext.js"></script>
@endsection

@section('content')
    <h1 class="page-header">@lang('arena.fight')</h1>

    @if (!$fight['fight_content'] && 0)
    	
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
				Combat en cours...
			</div>
	    </div>

	@elseif (0)

		Combat \o/

    @endif

    <div id="viewer"></div>

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