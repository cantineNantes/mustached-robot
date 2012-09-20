<?php

use Mustached\Message;

class Controller_Api extends \Controller_Rest
{
	/**
	 * Returns an array of associative arrays correctly formated according to the $this->response parameter 
	 *
	 * @param  Array $items   Array of associative array to filter
	 * @param  Array $return  Array with the key names to keep
	 * @return Array $result  The filtered Array of associative arrays
	 */
	protected function filter_array($items, $return) {
		foreach($items as $item) {
      		$result[] = \Arr::filter_keys($item, $this->return);
    	}
    	return $result;
	}


}
