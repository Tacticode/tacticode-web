{{--*/ $nav = 'characters' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script src="/js/tools/nodebuilder.js"></script>
@endsection

@section('content')
    <h1 class="page-header">NodeBuilder V0.1</h1>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-7">
            <canvas id="builder" width="800" height="600" style="border:1px solid #000000;" onselectstart="return false;" oncontextmenu="return false;"></canvas>
            <div><span id="selectedCircle"></span></div>
            <div><i id="selectedCircleDesc"></i></div>
        </div>
        <div class="col-md-2">
            <button id="create" class="btn btn-primary" onclick="changeMode(0);">Create Node (c)</button>
            <button id="move" class="btn btn-primary" onclick="changeMode(1);">Move Node (m)</button>
            <button id="link" class="btn btn-primary" onclick="changeMode(2);">Link Node (l)</button>
            <button id="delete" class="btn btn-primary" onclick="changeMode(3);">Delete Node (d)</button>
            <select id="powers" class="btn btn-secondary-outline">
                @foreach ($powers as $power)
                    <option value="{{$power->id}}" data-description="{{$power->description}}" data-spell="{{$power->spell}}">{{$power->name}}</option>
                @endforeach
            </select>
            <button id="paint" class="btn btn-primary" onclick="changeMode(4);">Paint Node (p)</button>
            <button id="paint" class="btn btn-primary" onclick="changeMode(5);">Clear Node (u)</button>
            <button id="save" class="btn btn-success" onclick="saveTree();">Save tree</button>
        </div>
        <div class="col-md-3">
            <button id="export" class="btn btn-primary" onclick="exportTree();">Export Tree</button>
            <textarea id="export_result" rows="10" cols="35" disabled="true"></textarea>
            <button id="import" class="btn btn-primary" onclick="importTree();">Import Tree</button>
            <textarea id="import_data" rows="10" cols="35"></textarea>
        </div>
    </div>

@endsection