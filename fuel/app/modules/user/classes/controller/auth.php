<?php

namespace User;
use Mustached\Message;

class Controller_Auth extends \Controller_Front
{

	public function action_login()
	{
		$fieldset = \Fieldset::forge('login');

		$form = $fieldset->form();
		$form->add('login', '', array('type' => 'text', 'placeholder' => __('mustached.user.email')), array(array('required'), array('valid_email')));
		$form->add('password', '', array('type' => 'password', 'placeholder' => __('mustached.user.password')), array(array('required')));
		$form->add('submit', '', array('type' => 'submit', 'value' => __('mustached.user.login.submit'), 'class' => 'btn btn-large btn-primary'));

		 // repopulate the form on errors
    	$fieldset->repopulate();

    	// set the appropriate data for the template
    	$this->data['form'] = $form->build();

    	if(\Input::method() == 'POST')
    	{
    		if($fieldset->validation()->run() == true)
      		{
        		$fields = $fieldset->validated();

                $auth = \Auth::instance();

                if ($user = $auth->validate_user())
                {

                    $auth->login();

                    $um = new Manager;
                    $um->save_user_session($user['email']);
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
        \Auth::logout();        
        $um = new Manager;
        $um->kill_user_session();

        $this->data['msg'] = Message::error('mustached.user.login.error'); 
        
		\Response::redirect('user/auth/login');
	}


}
