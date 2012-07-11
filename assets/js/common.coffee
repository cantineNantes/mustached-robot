$(document).ready ->	
	$("abbr.timeago").timeago()
	a = $('#companies').autocomplete({ serviceUrl:'/user/companies' })
