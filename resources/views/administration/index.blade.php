{{--*/ $nav = 'administration' /*--}}
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">@lang('administration.title')</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-sm-1">@lang('administration.userid')</th>
                    <th class="col-sm-1">@lang('administration.role')</th>
                    <th class="col-sm-4">@lang('administration.username')</th>
                    <th class="col-sm-4">@lang('administration.options')</th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($users as $key => $u)
            	 	@if ($u->id == Auth::user()->id)
            	 		<tr class="success">
		                    <td>{{ $u->id }}</td>
                            <td>{{ $u->group->name }}</td>
		                    <td>{{ $u->login }}</td>
		                    <td></td>
		                </tr>
            	 	@else
		                <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->group->name }}</td>
                            <td>{{ $u->login }}</td>
                            <td>
                                <a class="btn btn-primary" href="/administration/logas/{{ $u->id }}">@lang('administration.logas')</a>
                                @if ($u->banned)
                                    <a class="btn btn-success" href="/administration/unbann/{{ $u->id }}">@lang('administration.unbann')</a>
                                @else
                                    <a class="btn btn-danger" href="/administration/bann/{{ $u->id }}">@lang('administration.bann')</a>
                                @endif
                            </td>
		                </tr>
	                @endif
	            @endforeach
            </tbody>
        </table>
    </div>
@endsection