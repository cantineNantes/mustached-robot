$(document).ready(function() {
  var a;
  return a = $('#companies').autocomplete({
    serviceUrl: '/user/company/search'
  });

  $("abbr.timeago").timeago();

});
