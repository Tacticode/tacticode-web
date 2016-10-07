'use strict';

var METHOD = {
	CREATE: 0,
	MOVE: 1,
	LINK: 2,
	DELETE: 3,
	PAINT: 4,
	UNPAINT: 5
};

var text = document.getElementById('selectedCircle');
var textDesc = document.getElementById('selectedCircleDesc');

var c = document.getElementById("builder");
var ctx = c.getContext("2d");
var circles = [];
var links = [];
var isLoading = false;
var mouse = {x: 0, y: 0};
var id = 0;
var cTool = METHOD.MOVE;

var linking = null;
var moving = null;
var strictMode = false;
var strictMove = 10;

$(document).ready(init);

function init() {

	loading();
	$.getJSON('/tools/nodebuilder/getTalentTree', function(data) {
		
		isLoading = false;

		for (var i in data.nodes) {

			var node = data.nodes[i];
			if (node.race)
			{
				addRace(node.race.id, node.pos_x, node.pos_y);
				circles[circles.length - 1].nodeId = node.id;
			}
			else if (node.power)
			{
				if (node.power.type == 1)
				{
					addPassive(node.power.id, node.pos_x, node.pos_y);
				}
				else if (node.power.type == 2)
				{
					addPower(node.power.id, node.pos_x, node.pos_y);
				}
				else
				{
					addStatistique(node.power.id, node.pos_x, node.pos_y);
				}
				circles[circles.length - 1].nodeId = node.id;
			}
		}

		for (var i in data.paths) {

			addLinkByNodeId(data.paths[i].node_from, data.paths[i].node_to);
		}

		drawAll();
	});

	document.body.addEventListener('keypress', keypress, false);
	document.body.addEventListener('keydown', keydown, false);
	document.body.addEventListener('keyup', keyup, false);
	c.addEventListener('mousemove', mousemovement, false);
	c.addEventListener('mousedown', mousedown, false);
	c.addEventListener('mouseup', mouseup, false);
	c.addEventListener('selectstart', function(e) { e.preventDefault(); return false; }, false);
}

function roundTo(val, to)
{
	return (Math.round(val / to) * to);
}

function Circle(x, y, radius, powerId, strokeStyle, fillStyle, type) {

	this.id = id++;
	this.x = x;
	this.y = y;
	this.nodeId = 0;
	this.radius = radius;
	this.powerId = powerId;
	this.strokeStyle = strokeStyle;
	this.fillStyle = fillStyle;
	this.type = type;
	this.hover = false;
}

Circle.prototype.draw = function(ctx) {

	ctx.lineWidth = 3;
	ctx.beginPath();
	ctx.strokeStyle = this.strokeStyle;
	if (this.selected || this.bought || (this.hover && this.type == 'power' && this.available))
		ctx.fillStyle = this.strokeStyle;
	else
		ctx.fillStyle = this.fillStyle;
	ctx.beginPath();
	ctx.arc(this.x, this.y, this.radius, 0, Math.PI*2, true);
	ctx.fill();
	ctx.stroke();
}

function Link(id1, id2) {

	this.circle1 = null;
	this.circle2 = null;
	for (var i in circles) {

		if (circles[i].id == id1) {
			this.circle1 = circles[i];
		}
		if (circles[i].id == id2) {
			this.circle2 = circles[i];
		}
	}
}

Link.prototype.draw = function(ctx) {

	if (!this.circle1 || !this.circle2)
		return;
	ctx.lineWidth = 3;
	if (this.available)
		ctx.strokeStyle = 'black';
	else
		ctx.strokeStyle = '#999999';
	ctx.beginPath();
	ctx.moveTo(this.circle1.x, this.circle1.y);
	ctx.lineTo(this.circle2.x, this.circle2.y);
	ctx.stroke();
}

function addRace(raceId, x, y)
{
	circles.push(new Circle(x, y, 20, raceId, "#C25959", "#D49692", 'race'));
}

function addPower(powerId, x, y)
{
	circles.push(new Circle(x, y, 10, powerId, "#2E6dA4", "#4482B7", 'power'));
}

function addPassive(powerId, x, y)
{
	circles.push(new Circle(x, y, 10, powerId, "#7FAD76", "#9DD492", 'power'));
}

function addStatistique(powerId, x, y)
{
	circles.push(new Circle(x, y, 10, powerId, "#B380FF", "#D1B3FF", 'power'));
}

function addNode(x, y)
{
	circles.push(new Circle(x, y, 10, 0, '#000000', '#555555', 'power'));
}

function paintPower(circle)
{
	circle.strokeStyle = "#2E6dA4";
	circle.fillStyle = "#4482B7";
}

function paintPassive(circle)
{
	circle.strokeStyle = "#7FAD76";
	circle.fillStyle = "#9DD492";
}

function paintStatistique(circle)
{
	circle.strokeStyle = "#B380FF";
	circle.fillStyle = "#D1B3FF";
}

function paintClear(circle)
{
	circle.strokeStyle = "#000000";
	circle.fillStyle = "#555555";
}

function addLink(id1, id2) {

	links.push(new Link(id1, id2));
}

function addLinkByNodeId(id1, id2)
{
	var i1 = 0;
	var i2 = 0;
	for (var i in circles)
	{
		if (circles[i].nodeId == id1)
		{
			i1 = circles[i].id;
		}
		if (circles[i].nodeId == id2)
		{
			i2 = circles[i].id;
		}
	}
	addLink(i1, i2);
}

function drawSelect() {
	if (cTool == METHOD.LINK && linking != null)
	{
		ctx.lineWidth = 3;
		ctx.strokeStyle = '#00CD00';
		ctx.beginPath();
		ctx.moveTo(linking.x, linking.y);
		ctx.lineTo(mouse.x, mouse.y);
		ctx.stroke();
	}
}

function drawAll() {

	ctx.clearRect(0, 0, c.width, c.height);
	drawSelect();
	for (var i in links) {
		links[i].draw(ctx);
	}
	for (var i in circles) {
		circles[i].draw(ctx);
	}
	if (isLoading)
		loading();
}

function isInCircle(x, y, circle) {

	return (Math.pow(x - circle.x, 2) + Math.pow(y - circle.y, 2) < Math.pow(circle.radius, 2));
}

function showInfos()
{
	for (var i in circles)
	{
		var circle = circles[i];
		if (!circle.hover && isInCircle(mouse.x, mouse.y, circle))
		{
			circle.hover = true;
			if (circle.powerId > 0)
			{
				var power = $('#powers option[value='+circle.powerId+']');
				text.textContent = power.text();
				textDesc.textContent = power.data('description');
			}
		}
		else if (circle.hover && !isInCircle(mouse.x, mouse.y, circle))
		{
			circle.hover = false;
			text.textContent = '';
			textDesc.textContent = '';
		}
	}
}

function mousemovement(e) {

	mouse.x = e.offsetX;
	mouse.y = e.offsetY;
	if (cTool == METHOD.MOVE && moving != null)
	{
		if (strictMode)
		{
			moving.x = roundTo(mouse.x, strictMove);
			moving.y = roundTo(mouse.y, strictMove);
		}
		else
		{
			moving.x = mouse.x;
			moving.y = mouse.y;			
		}
	}
	showInfos();
	drawAll();
}

function createNode(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	if (strictMode)
	{
		x = roundTo(x, strictMove);
		y = roundTo(y, strictMove);
	}
	addNode(x, y);

	drawAll();
}

function removeNode(e)
{
	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (isInCircle(x, y, circle) && circle.type != 'race') {
			var j = links.length;
			while (j--) {
				if (links[j].circle1.id == circle.id || links[j].circle2.id == circle.id)
				{
					links.splice(j, 1);
				}
			}
			circles.splice(i, 1);
			return ;
		}
	}

	drawAll();
}

function clearNode(e)
{
	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (isInCircle(x, y, circle) && circle.type != 'race') {
			paintClear(circle);
			circle.powerId = 0;
		}
	}

	drawAll();
}

function paintNode(e)
{
	var painted = false;
	var power = $('#powers').find(":selected");
	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles)
	{
		var circle = circles[i];
		if (isInCircle(x, y, circle) && circle.type != 'race')
		{
			painted = true;
			if (power.data('type') == 1)
			{
				paintPassive(circle);
			}
			else if (power.data('type') == 2)
			{
				paintPower(circle);
			}
			else
			{
				paintStatistique(circle);
			}
			circle.powerId = power.val();
		}
	}
	if (!painted)
	{
		if (strictMode)
		{
			x = roundTo(x, strictMove);
			y = roundTo(y, strictMove);
		}
		if (power.data('type') == 1)
		{
			addPassive(power.val(), node.x, node.y);
		}
		else if (power.data('type') == 2)
		{
			addPower(power.val(), node.x, node.y);
		}
		else
		{
			addStatistique(power.val(), node.x, node.y);
		}
	}

	drawAll();
}

function linkBegin(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (isInCircle(x, y, circle)) {
			linking = circle;
			return ;
		}
	}
}

function linkEnd(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	if (linking == null)
		return ;
	for (var i in circles) {

		var circle = circles[i];
		if (circle.id != linking.id && isInCircle(x, y, circle)) {
			for (var i in links) {
				if ((links[i].circle1.id == linking.id && links[i].circle2.id == circle.id) ||
					(links[i].circle1.id == circle.id && links[i].circle2.id == linking.id))
				{
					links.splice(i, 1);
					linking = null;
					return;
				}
			}
			addLink(linking.id, circle.id);
			linking = null;
			return;
		}
	}
	linking = null;
}

function moveBegin(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (isInCircle(x, y, circle)) {
			moving = circle;
			return ;
		}
	}
}

function moveEnd(e) {

	moving = null;
}

function replaceStrict() {
	for (var i in circles) {
		circles[i].x = roundTo(circles[i].x, strictMove);
		circles[i].y = roundTo(circles[i].y, strictMove);
	}
	drawAll();
}

function mousedown(e) {

	switch (cTool) {
		case METHOD.CREATE:
			createNode(e);
			break;
		case METHOD.MOVE:
			moveBegin(e);
			break;
		case METHOD.LINK:
			linkBegin(e);
			break;
		case METHOD.DELETE:
			removeNode(e);
			break;
		case METHOD.PAINT:
			paintNode(e);
			break;
		case METHOD.UNPAINT:
			clearNode(e);
			break;
	}
}

function mouseup(e) {

	switch (cTool) {
		case METHOD.MOVE:
			moveEnd(e);
			break;
		case METHOD.LINK:
			linkEnd(e);
			break;
	}
}

function keypress(e) {
	switch (String.fromCharCode(e.keyCode))
	{
		case 'c':
			changeMode(METHOD.CREATE);
			break;
		case 'm':
			changeMode(METHOD.MOVE);
			break;
		case 'l':
			changeMode(METHOD.LINK);
			break;
		case 'd':
			changeMode(METHOD.DELETE);
			break;
		case 'p':
			changeMode(METHOD.PAINT);
			break;
		case 'u':
			changeMode(METHOD.UNPAINT);
			break;
		case 'r':
			replaceStrict();
			break;
	}
}

function changeMode(mode) {
	cTool = mode;
}

function keydown(e) {

	if (e.keyCode == 16 /*SHIFT*/) {
		strictMode = true;
	}
}

function keyup(e) {

	if (e.keyCode == 16 /*SHIFT*/) {
		strictMode = false;
	}
}

function loading() {

	isLoading = true;
	ctx.fillStyle = 'black';
	ctx.fillText('loading', 0, 10);
}

function addNodeToArray(array, node)
{
	var n = {
		powerId: node.powerId,
		x: node.x,
		y: node.y,
		type: node.type
	};
	array.nodes.push(n);
}

function addPathToArray(array, link)
{
	var l = {
		node_from: link.circle1.id,
		node_to: link.circle2.id
	};
	array.paths.push(l);
}

function toArray()
{
	var array = {
		nodes: [],
		paths: []
	};

	id = 0;
	for (var i in circles)
	{
		circles[i].id = id++;
		addNodeToArray(array, circles[i]);
	}
	for (var i in links)
	{
		addPathToArray(array, links[i]);
	}
	return array;
}

function saveTree()
{
	if (confirm("WARNING: If you save the talent tree, the database will be updated and all players' talent tree will be reset. Continue ?"))
	{
		$.post( "nodebuilder/saveTalentTree", { _token: $('input[name="_token"]').val(), tree: JSON.stringify(toArray()) },
			function(data, status) {
			    alert(data.result+": "+data.description);
			}
		);
	}
}

function exportTree()
{
	$('#export_result').val(JSON.stringify(toArray()));
}

function importTree()
{
	var tree;
	try {
		tree = jQuery.parseJSON($('#import_data').val());
	}
	catch (err) {
		$('#import_data').val(err);
		return;
	}
	circles = [];
	links = [];
	for (var i in tree.nodes) {

		var node = tree.nodes[i];
		if (node.type == 'race')
		{
			addRace(node.powerId, node.x, node.y);
		}
		else
		{
			if (node.powerId > 0)
			{
				var power = $('#powers option[value='+node.powerId+']');
				if (power.data('type') == 1)
				{
					addPassive(node.powerId, node.x, node.y);
				}
				else if (power.data('type') == 2)
				{
					addPower(node.powerId, node.x, node.y);
				}
				else
				{
					addStatistique(node.powerId, node.x, node.y);
				}
			}
			else
			{
				addNode(node.x, node.y);
			}
		}
	}

	for (var i in tree.paths)
	{
		addLink(circles[tree.paths[i].node_from].id, circles[tree.paths[i].node_to].id);
	}

	drawAll();

}

function exportSeeds()
{
	var schema = toArray();

	var nodes = "===== NODES =====\n"
	+ "<?php\n\n"
	+ "use Illuminate\\Database\\Seeder;\n"
	+ "use App\\Http\\Models\\Node;\n\n"
	+ "class NodeTableSeeder extends Seeder\n"
	+ "{\n"
	+ "\t/**\n"
	+ "\t * Run the database seeds.\n"
	+ "\t *\n"
	+ "\t * @return void\n"
	+ "\t */\n"
	+ "\tpublic function run()\n"
	+ "\t{\n"
	+ "\t\tDB::table('nodes')->delete();\n\n";

    for (var i in schema.nodes)
    {
    	var node = schema.nodes[i];
    	nodes += "\t\tNode::create(array('race_id' => " + (node.type == 'race' ? node.powerId : 'null') + ", 'power_id' => " + (node.type == 'power' ? node.powerId : 'null') + ", 'pos_x' => " + node.x + ", 'pos_y' => " + node.y + "));\n";
    }

    nodes += "\t}\n}\n";

    var paths = "\n===== PATHS =====\n"
    + "<?php\n\n"
    + "use Illuminate\\Database\\Seeder;\n"
    + "use App\\Http\\Models\\Path;\n\n"
    + "class PathTableSeeder extends Seeder\n"
    + "{\n"
    + "\t/**\n"
    + "\t * Run the database seeds.\n"
    + "\t *\n"
    + "\t * @return void\n"
    + "\t */\n"
    + "\tpublic function run()\n"
    + "\t{\n"
    + "\t\tDB::table('paths')->delete();\n\n";

    for (var i in schema.paths)
    {
    	var path = schema.paths[i];
    	paths += "\t\tPath::create(array('node_from' => " + (path.node_from + 1) + ", 'node_to' => " + (path.node_to + 1) + "));\n";
    }

    paths += "\t}\n}\n";

	window.open("data:text/text," + encodeURIComponent(nodes + paths), "_blank");
}