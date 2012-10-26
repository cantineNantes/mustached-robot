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

		// If the items is an array of arrays
		if(is_array($items[0]))
		{
			foreach($items as $item) 
			{
					$result[] = \Arr::filter_keys($item, $this->return);	
			}			
		}
		else
		{
			$result[] = \Arr::filter_keys($items, $this->return);	
		}

    	return $result;
	}


}
