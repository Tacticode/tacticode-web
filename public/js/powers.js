'use strict';

var token = document.getElementById('token').value;
var characterid = document.getElementById('characterid').value;
var raceid = document.getElementById('raceid').value;
var text = '';
var textDesc = '';
var powerLeft = document.getElementById('totalPowers').value;
var c = document.getElementById("powers");
var ctx = c.getContext("2d");
var circles = [];
var links = [];
var isLoading = false;
var mouse = {x: 0, y: 0};

function Circle(id, x, y, radius, name, strokeStyle, fillStyle, type, description) {

	this.id = id;
	this.x = Number(x);
	this.y = Number(y);
	this.radius = radius;
	this.name = name;
	this.strokeStyle = strokeStyle;
	this.fillStyle = fillStyle;
	this.type = type;
	this.description = description;
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
	ctx.font = "15px Arial";
	ctx.fillStyle = "white";
	var text = this.name.substr(0, 1);
	var measure = ctx.measureText(text);
	ctx.fillText(text, this.x - (measure.width / 2), this.y + 6);
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

function getAdjacentNodes(circle) {

	var connections = [];
	for (var linkId in links) {

		if (links[linkId].circle1.id == circle.id)
			connections.push(links[linkId].circle2);
		else if (links[linkId].circle2.id == circle.id)
			connections.push(links[linkId].circle1);
	}
	return connections;
}

function in_array_node(node, node_array) {

	for (var i in node_array) {
		if (node.id == node_array[i].id)
			return true;
	}
	return false;
}

function checkPathStart(node, initialNodes) {

	if (node.type == 'race' && node.selected == true)
		return true;
	var adjacentNodes = getAdjacentNodes(node);
	for (var i in adjacentNodes) {
		if ((adjacentNodes[i].bought || (adjacentNodes[i].type == 'race' && adjacentNodes[i].selected == true)) && !in_array_node(adjacentNodes[i], initialNodes)) {
			initialNodes.push(node);
			if (checkPathStart(adjacentNodes[i], initialNodes))
				return true;
			initialNodes.pop();
		}
	};
	return false;
}

function isSalable(circle) {

	if (!circle.bought)
		return false;
	var adjacentNodes = getAdjacentNodes(circle);
	for (var i in adjacentNodes) {

		var node = adjacentNodes[i];
		if (node.bought && !checkPathStart(node, [circle], false))
			return false;
	}
	return true;
}

function updateNodes() {

	for (var i in circles) {

		var circle = circles[i];
		if (isSalable(circle))
			circle.salable = true;
		else
			circle.salable = false;
	}
}

function addRace(id, name, x, y) {

	circles[id] = new Circle(id, x, y, 20, name, "#C25959", "#D49692", 'race');
}

function addPower(id, name, description, x, y) {

	circles[id] = new Circle(id, x, y, 10, name, "#2E6dA4", "#4482B7", 'power', description);
}

function addPassive(id, name, description, x, y) {

	circles[id] = new Circle(id, x, y, 10, name, "#7FAD76", "#9DD492", 'power', description);
}

function addStatistique(id, name, description, x, y) {

	circles[id] = new Circle(id, x, y, 10, name, "#B380FF", "#D1B3FF", 'power', description);
}


function addLink(id1, id2) {

	links.push(new Link(id1, id2));
}

function selectRace(race) {

	for (var i in circles) {

		if (circles[i].type == 'race' && circles[i].id == race) {

			circles[i].selected = true;
			for (var linkId in links) {

				if (links[linkId].circle1.id == circles[i].id || links[linkId].circle2.id == circles[i].id) {

					links[linkId].available = true;
					links[linkId].circle1.available = true;
					links[linkId].circle2.available = true;
				}
			}
		}
	}
}

function drawText() {
	
	if (!text && !textDesc)
		return;
	var measure = ctx.measureText(text);
	var measureDesc = ctx.measureText(textDesc);
	ctx.fillStyle = "#9E9E9E";
	var height = 47;
	if (!textDesc)
		height -= 18;
	var rectX = mouse.x - (measureDesc.width / 2) + 20;
	var textX = mouse.x - (measure.width / 2) + 35;
	var textDescX = mouse.x - (measureDesc.width / 2) + 35;
	if (rectX + measureDesc.width + 30 > 800) {
		var diff = rectX + measureDesc.width + 30 - 800 + 15;
		rectX -= diff;
		textX -= diff;
		textDescX -= diff;
	}
	if (rectX < 15) {
		var diff = 15 - rectX;
		rectX += diff;
		textX += diff;
		textDescX += diff;
	}
	var rectY = mouse.y - 70;
	var textY = mouse.y - 50;
	var textDescY = mouse.y - 35;
	if (rectY < 15) {
		var diff = 15 - rectY;
		rectY += diff;
		textY += diff;
		textDescY += diff;
	}
	ctx.fillRect(rectX, rectY, measureDesc.width + 30, height);
	ctx.font = "15px Arial";
	ctx.fillStyle = "black";
	ctx.fillText(text, textX, textY);
	ctx.font = "italic 15px Arial";
	if (textDesc)
		ctx.fillText(textDesc, textDescX, textDescY);
}

function drawAll() {

	ctx.clearRect(0, 0, c.width, c.height);
	for (var i in links) {
		links[i].draw(ctx);
	}
	for (var i in circles) {
		circles[i].draw(ctx);
	}
	if (isLoading)
		loading();
	drawText();
	document.getElementById('powerLeft').textContent = powerLeft;
}

function isInCircle(x, y, circle) {

	return (Math.pow(x - circle.x, 2) + Math.pow(y - circle.y, 2) < Math.pow(circle.radius, 2));
}

function mousemovement(e) {

	mouse.x = e.offsetX;
	mouse.y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (!circle.hover && isInCircle(mouse.x, mouse.y, circle)) {
			
			circle.hover = true;
			text = circle.name;
			textDesc = circle.description;
			if (circle.type == 'power' && circle.available && (!circle.bought || circle.salable))
				document.body.style.cursor = 'pointer';
		} else if (circle.hover && !isInCircle(mouse.x, mouse.y, circle)) {
			
			circle.hover = false;
			text = '';
			textDesc = '';
			if (circle.type == 'power')
				document.body.style.cursor = 'initial';
		}
	}
	drawAll();
}

function makeLinkAvailable(link) {

	if (link.circle1.type == 'race' && !link.circle1.selected)
		return;
	if (link.circle2.type == 'race' && !link.circle2.selected)
		return;
	link.available = true;
}

function frontBuyPower(circle) {

	powerLeft--;
	circle.bought = true;
	var connections = [];
	for (var linkId in links) {
		
		if (links[linkId].circle1.id == circle.id || links[linkId].circle2.id == circle.id) {

			makeLinkAvailable(links[linkId]);
			links[linkId].circle1.available = true;
			links[linkId].circle2.available = true;
			if (links[linkId].circle1.id == circle.id) {
				
				if (links[linkId].circle2.bought)
					connections.push(links[linkId].circle2);
			}
			else if (links[linkId].circle1.bought)
				connections.push(links[linkId].circle1);
		}
	}
	updateNodes();
	drawAll();
}

function buyPower(circle) {

	if (powerLeft <= 0)
		return;

	loading();

	$.ajax({
		type: 'post',
		url: '/characters/buynode',
		headers: {'X-XSRF-TOKEN' : token},
		data: {
			'character_id': characterid,
			'node_id': circle.id
		}, success: function(data) {

			isLoading = false;

			if (data.result != 'success') {
				frontSellPower(circle);
				alert(data.description);
			} else {

				frontBuyPower(circle);
			}
		}
	}, 'json');
}

function makeLinkNotAvailable(link) {

	if ((link.circle1.type == 'race' && link.circle1.selected) || link.circle1.bought)
		return;
	if ((link.circle2.type == 'race' && link.circle2.selected) || link.circle2.bought)
		return;
	link.available = false;
}

function frontSellPower(circle) {

	powerLeft++;
	circle.bought = false;
	for (var linkId in links) {
		if (links[linkId].circle1.id == circle.id || links[linkId].circle2.id == circle.id) {

			makeLinkNotAvailable(links[linkId]);
			if (links[linkId].circle1.id != circle.id && links[linkId].circle1.type == 'power') {

				if (!links[linkId].circle1.bought)
					links[linkId].circle1.available = false;
			}
			if (links[linkId].circle2.id != circle.id && links[linkId].circle2.type == 'power') {
			
				if (!links[linkId].circle2.bought)
					links[linkId].circle2.available = false;
			}
		}
	}
	updateNodes();
	drawAll();
}

function sellPower(circle) {

	loading();

	$.ajax({
		type: 'post',
		url: '/characters/sellnode',
		headers: {'X-XSRF-TOKEN' : token},
		data: {
			'character_id': characterid,
			'node_id': circle.id
		}, success: function(data) {

			isLoading = false;

			if (data.result != 'success') {
				frontBuyPower(circle);
				alert(data.description);
			} else {

				frontSellPower(circle);
			}
		}
	}, 'json');
}

function mouseclick(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (circle.type == 'power' && circle.available && isInCircle(x, y, circle)) {
			
			if (!circle.bought)
				buyPower(circle);
			else if (circle.salable)
				sellPower(circle);
		}
	}
	drawAll();
}

function resetPowers() {

	if (!(confirm(lang.sure)))
		return;

	$.ajax({
		type: 'post',
		url: '/characters/resetpower',
		headers: {'X-XSRF-TOKEN' : token},
		data: {'character_id': characterid}
	});

	for (var i in circles) {

		var circle = circles[i];
		circle.bought = false;
		circle.salable = false;
		circle.available = false;
		circle.selected = false;
	}
	for (var i in links) {

		var link = links[i];
		link.available = false;
	}
	powerLeft = document.getElementById('totalPowers').value;
	selectRace(raceid);
	drawAll();
}

function loading() {

	isLoading = true;
	ctx.fillStyle = 'black';
	ctx.fillText('loading', 0, 10);
}

function init() {

	loading();
	$.getJSON('/characters/' + characterid + '/powersinfos', function(data) {
		
		isLoading = false;

		for (var i in data.nodes) {

			var node = data.nodes[i];
			if (node.race)
				addRace(node.id, node.race.name, node.pos_x, node.pos_y);
			else if (node.power)
			{
				if (node.power.type == 1)
					addPassive(node.id, node.power.name, node.power.description, node.pos_x, node.pos_y);
				else if (node.power.type == 2)
					addPower(node.id, node.power.name, node.power.description, node.pos_x, node.pos_y);
				else
					addStatistique(node.id, node.power.name, node.power.description, node.pos_x, node.pos_y);			
			}
		}

		for (var i in data.paths) {

			addLink(data.paths[i].node_from, data.paths[i].node_to);
		}

		selectRace(raceid);

		for (var i in data.bought) {

			var circle = circles[data.bought[i].id];
			if (circle.type == 'power')
				frontBuyPower(circle);
		}

		updateNodes();
		drawAll();

		c.addEventListener('mousemove', mousemovement, false);
		c.addEventListener('mousedown', mouseclick, false);
		c.addEventListener('selectstart', function(e) { e.preventDefault(); return false; }, false);
	});
}

$(document).ready(init);