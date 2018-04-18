
const STARTING_YEAR = 1980;
const ENDING_YEAR = new Date().getFullYear();
var startYear = STARTING_YEAR;
var endYear = ENDING_YEAR;
var currentMonth = new Date().getMonth();
var startYears = [];
var startMonths = [];
var endYears = [];
var endMonths = [];
var $startYearOpt = $('#start-date-year');
var $startMonthOpt = $('#start-date-month');
var $endYearOpt = $('#end-date-year');
var $endMonthOpt = $('#end-date-month');

function initYears () {
  var years = [];
  for (let y = STARTING_YEAR; y <= ENDING_YEAR; y++) {
    years.push({year: y});
  }
  startYears = years;
  changeYears($endYearOpt, years[years.length-1].year, years[years.length-1].year);
}
function changeYears (c, s, e) {
  var years = [];
  for (let y = s; y <= e; y++) {
    years.push({year: y});
  }

  var m = c.val();
  c.children("option").remove();
  $.each(years, function(index, item) {
    c.append($("<option />").val(item.year).text(item.year));
  })
  var n = years[0].year;
  if (m <= n) {
    c.val(n);
  } else {
    c.val(m);
  }
}
function changeMonths (c) {
  var months = initMonths();
  var b = $startMonthOpt.val();
  console.log(b);
  var res = months.filter(q => q.id >= b);
  cs = c.val();
  c.children("option").remove();
  $.each(res, function(index, item) {
    c.append($("<option />").val(item.id).text(item.name));
  });
  if (cs < res[0].id) {
    c.val(res[0].id);
  } else {
    c.val(cs);
  }
}
function initMonths () {
  var months = [
    { id: 1, name: "January" },
    { id: 2, name: "February" },
    { id: 3, name: "March" },
    { id: 4, name: "April" },
    { id: 5, name: "May" },
    { id: 6, name: "June" },
    { id: 7, name: "July" },
    { id: 8, name: "August" },
    { id: 9, name: "September" },
    { id: 10, name: "October" },
    { id: 11, name: "November" },
    { id: 12, name: "December" }
  ]
  return months;
}
startMonths = initMonths();
endMonths = initMonths();
initYears();
$.each(startYears, function(index, item) {
  $startYearOpt.append($("<option />").val(item.year).text(item.year));
});
$.each(startMonths, function(index, item) {
  $startMonthOpt.append($("<option />").val(item.id).text(item.name));
});
$startYearOpt.val(endYear);
$startMonthOpt.val(currentMonth+1);
$.each(endYears, function(index, item) {
  $endYearOpt.append($("<option />").val(item.year).text(item.year));
});
function resetEndMonth() {
  $endMonthOpt.children("option").remove();
  $.each(endMonths, function(index, item) {
    $endMonthOpt.append($("<option />").val(item.id).text(item.name));
  });
}
resetEndMonth();
$endYearOpt.val(endYear);
$endMonthOpt.val(currentMonth+1);
$endYearOpt.change( function () {
  if ($endYearOpt.val() == $startYearOpt.val()) {
    changeMonths($endMonthOpt);
  } else {
    resetEndMonth();
  }
})
$startYearOpt.change( function() {
  startYear = $startYearOpt.val();
  changeYears($endYearOpt, startYear, endYear);
  if ($endYearOpt.val() == startYear) {
    changeMonths($endMonthOpt);
  } else {
    resetEndMonth();
  }
})
$startMonthOpt.change( function() {
  if ($startYearOpt.val() == $endYearOpt.val()) {
    changeMonths($endMonthOpt);
  }
})