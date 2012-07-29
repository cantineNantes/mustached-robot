<?php

namespace Checkin;
use Mustached\Message;

class Controller_Public extends \Controller_Front
{

  public function before()
  {
     parent::before();
  }

  public function action_test()
  {
    $return = array('id', 'user_id', 'reason_id', 'created_at', 'updated_at', 'public', 'killed');
    $m = new Manager;
    // return $this->response(array("pouet" => "pouet"));
    $checkin = $m->get_user_checkins(144);

    print_r($checkin);

    return $this->_render('add');

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

