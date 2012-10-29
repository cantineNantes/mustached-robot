<?php

namespace Twitter;

class Form
{

	/**
	 * Add a form element to the checkin menu
	 * @param  String $fieldname      Name of the field on which the new fill must be added
	 * @return String $before_after   Wether the new field must be append before or after the one defined in the first parameter
	 */
	public function addElementOnPublicCheckin()
	{					
		\Lang::load('twitter::twitter.yml', 'twitter');
		return array('before_after' => 'after', 'name' => 'twitter', 'label' => __('twitter.checkbox_label'), 'attributes' => array('type' => 'checkbox', 'value' => true), 'rules' => array(), 'fieldname' => 'reason');
	}
	

}