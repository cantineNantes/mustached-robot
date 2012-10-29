<?php

namespace Checkin;
use Mustached\Message;
use Mustached\Plugin;

class Controller_Public extends \Controller_Front
{

  public function before()
  {
     parent::before();
  }


  public function action_add()
  {
    $f = new Form;

    $email = null;

    if($this->current_user)
    {
      $email = $this->current_user['email'];
    }

    if(\Input::get('email'))
    {     
      $email = urldecode(\Input::get('email'));
    }

    $fieldset = $f->create_form($email);

  	$this->data['form'] = $fieldset->form()->build();


  	if (\Input::method() == 'POST')
    {
        $result = $f->create_from_form($fieldset);
        if($result === true) {
          
          $plugin = new Plugin();
          $plugin->pluginAction('Trigger', 'postCheckin', array('user' => $user, 'fieldset' => $fieldset));

          Message::flash_success('mustached.checkin.add.success');
          \Response::redirect('checkin/public/add');
        }
        else
        {
          $this->data['msg'] = Message::error($result);
        }
  	}

    return $this->_render('add');

	}


}

