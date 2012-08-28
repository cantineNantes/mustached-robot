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
    $fieldset = $f->create_form();

  	$this->data['form'] = $fieldset->form()->build();

  	if (\Input::method() == 'POST')
    {
        $result = $f->create_from_form($fieldset);
        if($result === true) {
          $plugin = new Plugin();
          $plugin->postCheckin();

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

