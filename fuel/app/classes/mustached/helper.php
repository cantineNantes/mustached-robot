<?php

namespace Mustached;

class Helper {

	public static function avatar($email, $size = '80')
	{
		return 'http://www.gravatar.com/avatar/'.md5($email).'?s='.$size.'&d=mm';
	}

}
