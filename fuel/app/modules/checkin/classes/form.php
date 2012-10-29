<?php

namespace Checkin;
use Mustached\Message;
use Mustached\Plugin;

class Form
{

	/**
	 * Return a form for a checkin
	 * @param  String $email 	(optional) Email to fill the email field with
	 * @return Fieldset
	 */
	public function create_form($email = null)
	{

		$reasons = \Arr::assoc_to_keyval(
  		\DB::select('id', 'name')
			->from('reasons')
			->order_by('order', 'asc')
			->execute()->as_array(),
  		'id', 'name');

		$fieldset = \Fieldset::forge('checkin');

		$fieldset->add('email',
					   '',
					   array('type' => 'text', 'class' => 'giant', 'placeholder' => __('mustached.user.email'), 'autocomplete' => 'off', 'value' => $email),
					   array(array('required'), array('valid_email'))
					   );

		$fieldset->add('reason',
			           __('mustached.checkin.reason.label'),
			           array('type' => 'select', 'class' => 'giant', 'options' => $reasons)
			           );

		$fieldset->add('submit',
					   '',
					   array('type' => 'submit', 'value' => __('mustached.checkin.add.submit'), 
					   'class' => 'btn btn-large btn-primary', 'data-wait' => __('mustached.user.form.wait'))
					   );		

		$plugin = new Plugin();		
        $fieldset = $plugin->addToForm('publicCheckin', $fieldset);

		$fieldset->repopulate();

		return $fieldset;
	}

	/**
	 * Create a checkin from the data returned by a form. If the users doesn't exists, he will be redirected to the registration form
	 * @param \Fieldset $fieldset The fieldset submited by the user containing the data
	 * @return bool|String Returns true on success of a String (containing the error message) on failure
	 */
	public function create_from_form($fieldset)
	{
		if ($fieldset->validation()->run() == true)
        {
			$fields = $fieldset->validated();
			$user = \User\Model_User::find()->where('email', '=', $fields['email'])->get_one();
			if (!$user)
          	{
        		Message::flash_error('mustached.checkin.add.accountDoesntExistCreate');
				\Response::redirect('user/account/add?email='.urlencode($fields['email']));
          	}
          	else
          	{
          		$m = new Manager;
          		return $m->add_checkin($user, Model_Reason::find($fields['reason']));
			}
			
		}
		else {
			return __('mustached.checkin.add.error');
		}
	}
}
