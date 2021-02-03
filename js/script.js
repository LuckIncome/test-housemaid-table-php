$(document).ready(function() {

	var scoreDay = $("#tableDay #scoreDay");	
	var sumDay = 0;
	scoreDay.each(function() {
	  sumDay += +$(this).text();
	  return sumDay;
	});	
	var summOfDay = $("#summOfDay");
	summOfDay.append().text('итоговая сумма за день: ' + sumDay.toFixed(2));

	var scoreMonth = $("#tableMonth #scoreMonth");	
	var sumMonth = 0;
	scoreMonth.each(function() {
	  sumMonth += +$(this).text();
	  return sumMonth;
	});	
	var summOfMonth = $("#summOfMonth");
	summOfMonth.append().text('итоговая сумма за день: ' + sumMonth.toFixed(2));

});