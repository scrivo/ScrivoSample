var serverDate = new Date();
var maxDate = new Date();
var dayAvailabilities = {};

var defaultDateString = 'dd-mm-yyyy';
var months = new Array("jan", "feb", "maa", "apr", "mei", "jun", "jul", "aug",
		"sep", "okt", "nov", "dec");
var days = new Array("ma", "di", "wo", "do", "vr", "za", "zo");
var isMouseOverCalendar = false;
var selectedDayInput;
var selectedMonthInput;
var selectedYearInput;
var selectedDate;
var currentDate;
var inputDateField;
var reservationsUrl;
var timesUrl;
function drawCalendar(a) {
	var b = currentDate.getMonth();
	var c = currentDate.getFullYear();
	var d = months;
	var e = days;
	var f = new Date(c, b, 1);
	var g = new Date(c, b + 1, 1);
	var h = f.getDay();
	var i = Math.round((g.getTime() - f.getTime()) / (1e3 * 60 * 60 * 24));
	var j = "<table id='calendar' width='182' border='0' cellspacing='0' callpadding='0'>";
	j += "<tr id='jsCalendar-links'>";
	j += "<td>";
	if (serverDate.getFullYear() < c || serverDate.getFullYear() == c
			&& b > serverDate.getMonth()) {
		var k = "<a class='left' href=\"javascript:getPrevMonth(new Date('"
				+ currentDate + "'));drawCalendar('" + a + "');\"> </a>";
		j += k;
	} else
		j += " ";
	j += "</td>";
	j += "<td id='month' colspan='5'>" + d[b] + " " + c + "</td>";
	j += "<td>";
	if (maxDate.getFullYear() > c || maxDate.getFullYear() == c
			&& b < maxDate.getMonth()) {
		var l = "<a class='right' href=\"javascript:getNextMonth(new Date('"
				+ currentDate + "'));drawCalendar('" + a + "');\"> </a>";
		j += l;
	} else
		j += " ";
	j += "</td>";
	j += "</tr>";
	j += "<tr id='days'>";
	for (var q = 0; q < e.length; q++) {
		j += "<td>" + e[q] + "</td>";
	}
	j += "</tr>";
	j += "<tr>";
	if (h == 0)
		h = 7;
	for ( var m = 1; m < h; m++) {
		j += "<td> </td>";
	}
	var n = false;
	m = h - 1;
	for ( var o = 1; o <= i; o++) {
		m %= 7;
		if (m == 0)
			j += "</tr><tr>";
		var av = dayAvailabilities[c + ''
				+ ((b + 1) < 10 ? '0' + (b + 1) : (b + 1))];
		if (av.charAt(o - 1) == 1 || av.charAt(o - 1) == 2)
			n = true;
		else
			n = false;
		var p = "";
		if (c == selectedDate.getFullYear() && b == selectedDate.getMonth()
				&& selectedDate.getDate() == o) {
			p = " selected";
			n = true;
		}
		if (n)
			j += "<td class='active" + p + "'><a href=\"javascript:selectDay("
					+ o + ",'" + a + "');\">" + o + "</a></td>";
		else
			j += "<td class='inactive" + p + "'>" + o + "</td>";
		m++;
	}
	for ( var q = m; q < 7; q++) {
		j += "<td> </td>";
	}
	j += "</tr>";
	j += "</table>";
	document.getElementById(a).innerHTML = j;
	setVisible(true, a);
}
function getPrevMonth(a) {
	var b = a.getMonth();
	var c = a.getFullYear();
	var d = a.getDate();
	if (b == 0) {
		b = 11;
		c--;
	} else {
		b--;
	}
	currentDate = new Date(c, b, d);
}
function getNextMonth(a) {
	var b = a.getMonth();
	var c = a.getFullYear();
	var d = a.getDate();
	if (b == 11) {
		b = 0;
		c++;
	} else {
		b++;
	}
	currentDate = new Date(c, b, d);
}
function parseDateString(dateString) {
	function trim(a) {
		var b = /\s{2,10}/g;
		a = a.replace(b, " ");
		while (a.substring(0, 1) == " ") {
			a = a.substring(1, a.length);
		}
		while (a.substring(a.length - 1, a.length) == " ") {
			a = a.substring(0, a.length - 1);
		}
		return a;
	}
	function delimit(a) {
		var b;
		var c = /,\s/g;
		var d = /([-]|[|]|[.]|[,]|[;]|[\s]|[\/])/g;
		b = a.replace(c, ",");
		b = b.replace(d, "|");
		b = b.toLowerCase();
		return b;
	}
	function convertMonthAbbreviation(a) {
		var b;
		var c;
		var d;
		var e = /^[a-zA-Z]*/;
		var f = /^[a-zA-Z]{3}/;
		var g = new Array("jan", "feb", "mar", "apr", "may", "jun", "jul",
				"aug", "sep", "oct", "nov", "dec");
		if (a.length < 3)
			return;
		if (a.match(e)) {
			b = a.match(f);
			for ( var h = 0; h < g.length; h++) {
				if (b == g[h]) {
					c = h + 1;
					d = a.replace(e, c);
					return d;
				}
			}
		}
	}
	function matchPattern(a) {
		var b = a;
		var c = a;
		var d = /^(\d{1,2})([|]\d{1,2})([|](\d{2}){1,2})?$/i;
		var e = /^([a-zA-z])/;
		if (b.match(e)) {
			c = convertMonthAbbreviation(b);
		}
		if (c.match(d)) {
			return c;
		}
		return b;
	}
	function parseDateMain(a) {
		var b;
		var c;
		var d;
		b = trim(a);
		c = delimit(b);
		d = matchPattern(c);
		setDateInputs(d);
	}
	function setDateInputs(a) {
		var b = "|";
		if (a != null) {
			var c = a.split(b);
			if (defaultDateString == "mm-dd-yyyy"
					|| defaultDateString == "mm-dd-yy") {
				selectedMonthInput = c[0];
				selectedDayInput = c[1];
				selectedYearInput = c[2];
			} else if (defaultDateString == "yyyy-mm-dd"
					|| defaultDateString == "yy-mm-dd") {
				selectedMonthInput = c[1];
				selectedDayInput = c[2];
				selectedYearInput = c[0];
			} else if (defaultDateString == "dd-mm-yyyy"
					|| defaultDateString == "dd-mm-yy"
					|| defaultDateString == "dd.mm.yyyy"
					|| defaultDateString == "dd.mm.yy") {
				selectedMonthInput = c[1];
				selectedDayInput = c[0];
				selectedYearInput = c[2];
			} else {
				return;
			}
		} else {
			return;
		}
	}
	parseDateMain(dateString);
}
function getInputDate(a, b, c) {
	closeCalendar(c);
	inputDateField = a;
	var d = new Date;
	var e = d.getMonth() + 1 + "-" + d.getDate() + "-" + d.getFullYear();
	if (b.length < 1) {
		b = e;
	}
	try {
		parseDateString(b);
	} catch (f) {
		parseDateString(e);
	}
	if (parseToSingleDigit(selectedMonthInput) > 12) {
		parseDateString(e);
	}
	var g = parseToSingleDigit(selectedMonthInput);
	var h = parseToSingleDigit(selectedDayInput);
	var i = selectedYearInput.length <= 2 ? "20" + selectedYearInput
			: selectedYearInput;
	currentDate = new Date(i, g - 1, h);
	selectedDate = currentDate;
}
function selectDay(a, b) {
	var c = a;
	var d = currentDate.getMonth() + 1;
	var e = currentDate.getFullYear();
	if (defaultDateString == "mm-dd-yyyy" || defaultDateString == "mm-dd-yy") {
		inputDateField.value = parseToDoubleDigit(d) + "-"
				+ parseToDoubleDigit(c) + "-" + e;
	} else if (defaultDateString == "yyyy-mm-dd"
			|| defaultDateString == "yy-mm-dd") {
		inputDateField.value = e + "-" + parseToDoubleDigit(d) + "-"
				+ parseToDoubleDigit(c);
	} else if (defaultDateString == "dd-mm-yyyy"
			|| defaultDateString == "dd-mm-yy") {
		inputDateField.value = parseToDoubleDigit(c) + "-"
				+ parseToDoubleDigit(d) + "-" + e;
	} else if (defaultDateString == "dd.mm.yyyy"
			|| defaultDateString == "dd.mm.yy") {
		inputDateField.value = parseToDoubleDigit(c) + "."
				+ parseToDoubleDigit(d) + "." + e;
	}
	refreshAvailabilities();
	closeCalendar(b);
}
function closeCalendar(a) {
	setVisible(false, a);
}
function setVisible(a, b) {
	if (document.getElementById(b)) {
		var c = document.getElementById(b);
	} else {
		return;
	}
	if (a) {
		c.style.display = "block";
	} else {
		c.style.display = "none";
	}
}
function parseToDoubleDigit(a) {
	return a < 10 ? "0" + a : a;
}
function parseToSingleDigit(a) {
	var b = "" + a;
	return b.replace(/^0+/g, "");
}

function calendarOuterClick(e) {
	var b = new Object;
	if (!e) {
		if (window.event) {
			e = window.event;
		} else {
			return
		}
	}
	if (document.all) {
		b = e.srcElement;
	} else {
		b = e.target;
	}
	if (!isMouseOverCalendar && b.name != "date") {
		closeCalendar("jsCalendar");
	}
}
function refreshAvailabilities() {
	doGet(timesUrl, null, 	
		function (data) {
			if (data && data.times) {
				var select = document.getElementById('resTime');
				select.options.length = 0;
				for (var i in data.times) {
					select.options.add(new Option(data.times[i], i));
				}
			}
		}
	);
}
function doGet(url, data, callback) {
	// create an XMLHttpRequest obj, if not the normal way then the MS way
	var xhr = window.XMLHttpRequest
		? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	// if there's data append it to the url
	if (data) {
		var t = [];
		// create name and url-encoded values pairs
		for (var i in data) {
			if (data.hasOwnProperty(i)) {
				if (data[i] instanceof Array) {
					// create PHP style array parameters
					for (var j=0; j<data[i].length; j++) {
						t.push(i+"[]="+encodeURIComponent(data[i][j]));
					}
				} else {
					t.push(i+"="+encodeURIComponent(data[i]));
				}
			}
		}
		// construct the complete query string
		url += "?" + t.join("&");
	}
	// set the callback ...
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			var c = false;
			try {
				if (typeof xhr.responseText == "string") {
					c = JSON.parse(xhr.responseText);
				} else {
					c = JSON.parse(JSON.stringify(xhr.responseText));
				}
			} catch (d) {
				c = eval("(" + xhr.responseText + ")");
			}
			callback(c);
		}
	};
	// ... open the connection ...
	xhr.open("GET", url, true);
	// ... and don't send any data.
	xhr.send(null);
};
function initializeCalendar(
		serverDt, maxDt, dayAvail, aTimesUrl, aReservationsUrl) {
	serverDate = serverDt;
	maxDate = maxDt;
	dayAvailabilities = dayAvail;
	timesUrl = aTimesUrl;
	reservationsUrl = aReservationsUrl;
	document.getElementById('jsCalendar').onmouseover = function() {
		isMouseOverCalendar = true;
	};
	document.getElementById('jsCalendar').onmouseout = function() {
		isMouseOverCalendar = false;
	};
	document.onclick = calendarOuterClick;
}

Util = {
	ltrim: function(s) {
		return s.replace(/^[\s\xA0\t\r\n]+/,"");
	},
	rtrim: function(s) {
		return s.replace(/[\s\xA0\t\r\n]+$/,"");
	},
	trim: function(s) {
		return this.ltrim(this.rtrim(s));
	}
}

function makeReservation() {

	var res = { 
		resName: "", resContact: "", resDate: "", resPersons: "", resTime: ""
	};
	for (var i in res) {
		res[i] = Util.trim(document.getElementById(i).value);
	}
	doGet(reservationsUrl, res, 	
		function (data) {
			try {
				if (data.error) {
					alert(data.error);  
				} else {
					alert(data.message);
				}
			} catch (e) {
				alert("Fout bij het reseveren, probeer het later opnieuw");
			}
		}
	);
	return false;
}


