$(document).ready ->	
	$("#skills").autoSuggest('/user/companies', { minChars: 2, matchCase: false, selectedItemProp: "name", searchObjProps: "name", selectionLimit: 3; })