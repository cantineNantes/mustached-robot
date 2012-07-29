<?php

namespace User;
use Mustached\Message;

class Controller_Auth extends \Controller_Front
{

	public function action_login()
	{
		$fieldset = \Fieldset::forge('login');

		$form = $fieldset->form();
		$form->add('login', 'Login', array('type' => 'text'), array(array('required'), array('valid_email')));
		$form->add('password', 'Password', array('type' => 'password'), array(array('required')));
		$form->add('submit', '', array('type' => 'submit', 'value' => 'Login', 'class' => 'btn medium primary'));

		 // repopulate the form on errors
    	$fieldset->repopulate();

    	// set the appropriate data for the template
    	$this->data['form'] = $form->build();

    	if(\Input::method() == 'POST')
    	{

    		if($fieldset->validation()->run() == true)
      		{
        		$fields = $fieldset->validated();
        		$auth = new Auth();
        		if($auth->login($fields['login'], $fields['password']))
        		{
                    Message::flash_success('mustached.user.login.success');
                    if($redirect = \Session::get_flash('redirect')) {
                        \Response::redirect($redirect);
                    }

                    \Response::redirect('user/account/edit');
        		}
        		else
        		{
        			$this->data['msg'] = Message::error('mustached.user.login.error');
        		}
        	}
    	}
        else {
            if(\Session::get_flash('redirect')) {
                \Session::keep_flash('redirect');
            }
        }

    	return $this->_render('login');

	}

	public function action_logout()
	{
		$auth = new Auth();
		$auth->logout();
		\Response::redirect('user/auth/login');
	}


}
