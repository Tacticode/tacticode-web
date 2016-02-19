'use strict';

var text = document.getElementById('selectedCircle');
var c = document.getElementById("powers");
var ctx = c.getContext("2d");
var circles = [];
var links = [];

function Circle(id, x, y, radius, name, strokeStyle, fillStyle, type) {

	this.id = id;
	this.x = x;
	this.y = y;
	this.radius = radius;
	this.name = name;
	this.strokeStyle = strokeStyle;
	this.fillStyle = fillStyle;
	this.type = type;
	this.hover = false;
}

Circle.prototype.draw = function(ctx) {

	ctx.lineWidth = 3;
	ctx.beginPath();
	ctx.strokeStyle = this.strokeStyle;
	if (this.selected || (this.hover && this.type == 'power'))
		ctx.fillStyle = this.strokeStyle;
	else
		ctx.fillStyle = this.fillStyle;
	ctx.beginPath();
	ctx.arc(this.x,this.y,this.radius,0,Math.PI*2,true);
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

function addRace(id, name, x, y) {

	circles.push(new Circle(id, x, y, 20, name, "#AD7A76", "#D49692", 'race'));
}

function addPower(id, name, x, y) {

	circles.push(new Circle(id, x, y, 10, name, "#7FAD76", "#9DD492", 'power'));
}

function addLink(id1, id2) {

	links.push(new Link(id1, id2));
}

function addRaces() {

	addRace(1, 'Humain', 320, 220);
	addRace(2, 'Gobelin', 480, 220);
	addRace(3, 'Orc', 320, 380);
	addRace(4, 'Elfe', 480, 380);
}

function selectRace(race) {

	for (var i in circles) {

		if (circles[i].type == 'race' && circles[i].name == race) {

			circles[i].selected = true;
			for (var linkId in links) {

				if (links[linkId].circle1.id == circles[i].id || links[linkId].circle2.id == circles[i].id) {

					links[linkId].available = true;
				}
			}
		}
	}
}

function addPowers() {

	addPower(5, 'Stats 1', 350, 300);
	addPower(6, 'Stats 2', 450, 300);
	addPower(7, 'Stats 3', 400, 250);
	addPower(8, 'Stats 4', 400, 350);
	addPower(9, 'Stats 5', 375, 325);
	addPower(10, 'Stats 6', 425, 325);
	addPower(11, 'Stats 7', 375, 275);
	addPower(12, 'Stats 8', 425, 275);
	addPower(13, 'Stats 9', 300, 300);
	addPower(14, 'Stats 10', 500, 300);
	addPower(15, 'Stats 11', 400, 200);
	addPower(16, 'Stats 12', 400, 400);
}

function addLinks() {

	addLink(1, 11);
	addLink(2, 12);
	addLink(3, 9);
	addLink(4, 10);
	addLink(11, 7);
	addLink(7, 12);
	addLink(12, 6);
	addLink(6, 10);
	addLink(10, 8);
	addLink(8, 9);
	addLink(9, 5);
	addLink(5, 11);
	addLink(7, 15);
	addLink(5, 13);
	addLink(6, 14);
	addLink(8, 16);
}

function drawAll() {

	ctx.clearRect(0, 0, c.width, c.height);
	for (var i in links) {
		links[i].draw(ctx);
	}
	for (var i in circles) {
		circles[i].draw(ctx);
	}
}

addRaces();
addPowers();
addLinks();

selectRace('Humain');

drawAll();

function isInCircle(x, y, circle) {

	return (Math.pow(x - circle.x, 2) + Math.pow(y - circle.y, 2) < Math.pow(circle.radius, 2));
}

function mousemovement(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (!circle.hover && isInCircle(x, y, circle)) {
			
			circle.hover = true;
			text.textContent = circle.name;
			if (circle.type == 'power')
				document.body.style.cursor = 'pointer';
		} else if (circle.hover && !isInCircle(x, y, circle)) {
			
			circle.hover = false;
			text.textContent = '';
			if (circle.type == 'power')
				document.body.style.cursor = 'initial';
		}
	}
	drawAll();
}

function mouseclick(e) {

	var x = e.offsetX;
	var y = e.offsetY;
	for (var i in circles) {

		var circle = circles[i];
		if (circle.type == 'power' && isInCircle(x, y, circle)) {
			
			console.log('power');
		}
	}
	drawAll();
}

c.addEventListener('mousemove', mousemovement, false);
c.addEventListener('mousedown', mouseclick, false);
c.addEventListener('selectstart', function(e) { e.preventDefault(); return false; }, false);
