'use strict';

var METHOD = {
	CREATE: 0,
	MOVE: 1,
	LINK: 2
};

var c = document.getElementById("builder");
var ctx = c.getContext("2d");
var circles = [];
var links = [];
var isLoading = false;
var mouse = {x: 0, y: 0};
var id = 0;
var cTool = METHOD.CREATE;

var linking = null;
var moving = null;
var strictMode = false;
var strictMove = 10;

$(document).ready(init);

function init() {

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

function addRace(raceId, x, y) {

	circles.push(new Circle(x, y, 20, raceId, "#C25959", "#D49692", 'race'));
}

function addPower(powerId, x, y) {

	circles.push(new Circle(x, y, 10, powerId, "#2E6dA4", "#4482B7", 'power'));
}

function addPassive(powerId, x, y) {

	circles.push(new Circle(x, y, 10, powerId, "#7FAD76", "#9DD492", 'power'));
}

function addNode(x, y)
{
	circles.push(new Circle(x, y, 10, 0, '#000000', '#555555', 'power'));
}

function addLink(id1, id2) {

	links.push(new Link(id1, id2));
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
	drawAll();
}

function createNode(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (isInCircle(x, y, circle)) {
			circles.splice(i, 1);
			return ;
		}
	}
	if (strictMode)
	{
		x = roundTo(x, strictMove);
		y = roundTo(y, strictMove);
	}
	addNode(x, y);

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
			cTool = METHOD.CREATE;
			break;
		case 'm':
			cTool = METHOD.MOVE;
			break;
		case 'l':
			cTool = METHOD.LINK;
			break;
		case 'r':
			replaceStrict();
			break;
	}
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
