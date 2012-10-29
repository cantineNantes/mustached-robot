<?php

namespace Test;

class Form
{

	/**
	 * Add a form element to the checkin menu
	 * @param  String $fieldname      Name of the field on which the new fill must be added
	 * @return String $before_after   Wether the new field must be append before or after the one defined in the first parameter
	 */
	public function addElementOnPublicCheckin()
	{					
		return array('before_after' => 'before', 'name' => 'test_name_field', 'label' => __('twitter.checkbox_label'), 'attributes' => array('type' => 'checkbox', 'value' => true), 'rules' => array(), 'fieldname' => $fieldname);
	}

}