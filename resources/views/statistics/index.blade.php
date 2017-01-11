{{--*/ $nav = 'statistics' /*--}}
@extends('layouts.dashboard')

@section('page-scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data_solo = google.visualization.arrayToDataTable([
            ['Result', 'Amount'],
            ['Victories', {{ $soloFights['win'] }}],
            ['Draws', {{ $soloFights['draw'] }}],
            ['Defeats', {{ $soloFights['loss'] }}]
        ]);

        var data_team = google.visualization.arrayToDataTable([
            ['Result', 'Amount'],
            ['Victories', {{ $teamFights['win'] }}],
            ['Draws', {{ $teamFights['draw'] }}],
            ['Defeats', {{ $teamFights['loss'] }}]
        ]);

        var data_total = google.visualization.arrayToDataTable([
            ['Result', 'Amount'],
            ['Victories', {{ $soloFights['win'] + $teamFights['win'] }}],
            ['Draws', {{ $soloFights['draw'] + $teamFights['draw'] }}],
            ['Defeats', {{ $soloFights['loss'] + $teamFights['loss'] }}]
        ]);

        var options = {
            title: 'Solo Fights',
            backgroundColor: 'none',
            pieSliceText: 'value-and-percentage',
            chartArea: { top: 20, left: 130, width: '100%', height: '100%' },
            slices: {
                0: { color: '#4cae4c' },
                1: { color: '#eea236' },
                2: { color: '#d43f3a' }
            }
        };
        var options_team = JSON.parse(JSON.stringify(options));
        options_team.title = 'Team Fights';
        var options_total = JSON.parse(JSON.stringify(options));
        options_total.title = 'All Fights';

        var solo = new google.visualization.PieChart(document.getElementById('solo-chart'));
        var team = new google.visualization.PieChart(document.getElementById('team-chart'));
        var total = new google.visualization.PieChart(document.getElementById('total-chart'));

        solo.draw(data_solo, options);
        team.draw(data_team, options_team);
        total.draw(data_total, options_total);
    }
    </script>
@endsection

@section('page-styles')
@endsection

@section('content')
     
    <h1 class="page-header">@lang('statistics.title')</h1>

    <div id="total-chart" style="width: 600px; height: 400px; margin-left: auto; margin-right: auto;" align="center"></div>

    <div style="width: 1220px; height: 400px; margin-left: auto; margin-right: auto; margin-top: 10px;">
        <div id="solo-chart" style="width: 600px; height: 400px; display: inline-block;"></div>
        <div id="team-chart" style="width: 600px; height: 400px; display: inline-block;"></div>
    </div>
@endsection