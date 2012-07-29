<?php

namespace Checkin;
use Mustached\Message;

class Form
{

	/**
	 * Return a form for a checkin
	 * @return Fieldset
	 */
	public function create_form()
	{

		$reasons = \Arr::assoc_to_keyval(
  		\DB::select('id', 'name')
			->from('reasons')
			->order_by('order', 'asc')
			->execute()->as_array(),
  		'id', 'name');

		$fieldset = \Fieldset::forge('checkin');

		$fieldset->add('email',
					   __('mustached.user.email'),
					   array('type' => 'text'),
					   array(array('required'), array('valid_email'))
					   );

		$fieldset->add('reason',
			           __('mustached.checkin.reason.label'),
			           array('type' => 'select', 'options' => $reasons)
			           );

		$fieldset->add('submit',
					   '',
					   array('type' => 'submit', 'value' => __('mustached.checkin.add.submit'),
					   'class' => 'btn btn-medium btn-primary')
					   );

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
				$checkin = new Model_Checkin;
				$checkin->user = $user;
				$checkin->reason = Model_Reason::find($fields['reason']);
				$checkin->count = 1;
				$checkin->public = 1;
				$checkin->killed = 0;
				$checkin->save();
			}
			return true;
		}
		else {
			return __('mustached.checkin.add.error');
		}
	}
}
