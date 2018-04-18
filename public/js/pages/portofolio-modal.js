$('#project-ongoing').click(() => {
  var isOngoing = $('#project-ongoing').prop('checked');
  if (isOngoing) {
    $('#end-date-month').addClass('disabled').attr('disabled', true);
    $('#end-date-year').addClass('disabled').attr('disabled', true);
  } else {
    $('#end-date-month').removeClass('disabled').attr('disabled', false);
    $('#end-date-year').removeClass('disabled').attr('disabled', false);
  }
});
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
    { id: "January", name: "January" },
    { id: "February", name: "February" },
    { id: "March", name: "March" },
    { id: "April", name: "April" },
    { id: "May", name: "May" },
    { id: "June", name: "June" },
    { id: "July", name: "July" },
    { id: "August", name: "August" },
    { id: "September", name: "September" },
    { id: "October", name: "October" },
    { id: "November", name: "November" },
    { id: "December", name: "December" }
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