$(document).ready(function() {
  var a;
  return a = $('#companies').autocomplete({
    serviceUrl: '/user/companies/search.json'
  });

  $("abbr.timeago").timeago();



});
