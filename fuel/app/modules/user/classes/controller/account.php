<?php

namespace User;
use Mustached\Message;

class Controller_Account extends \Controller_Front
{

  public function before()
  {
     parent::before();
  }


  public function action_add()
  {

    $fm = new Form;
    $fieldset = $fm->create_form(null, urldecode(\Input::get('email')));

    $this->data['form'] = $fieldset->form()->build();

    if(\Input::method() == 'POST')
    {    
        $um = new Manager;

        $result = $fm->create_user_from_form($fieldset);
        
        if(is_int($result))
        {
           Message::flash_success('mustached.user.save_success');
          \Response::redirect('checkin/public/add');
        }
        else
        {
           $this->data['msg'] = Message::error($result);
        }
    }
    return $this->_render('add');
  }

  public function action_test()
  {
    $um = new Manager;
    echo $this->um->get_user($id);

    return $this->_render('add');    
  }



  public function action_edit($id = null)
  {
    if(!$id) {
      $id = $this->current_user['user_id'];
    }

    $fm = new Form;
    $fieldset = $fm->create_form($id);

    $this->data['form'] = $fieldset->form()->build();

    // If the form is submitted and the datas are valid
    if (\Input::method() == 'POST')
    {
        $result = $fm->update_user_from_form($id, $fieldset);
        if ($result === true)
        {
           $this->data['msg'] = Message::success('mustached.user.update_success');
        }
        else
        {
           $this->data['msg'] = Message::error($result);
        }
    }

    return $this->_render('edit');

  }

  public function action_edit_password()
  {

    $fieldset = \Fieldset::forge('edit_password');

    $form = $fieldset->form();
    $form->add('current_password', \Lang::get('mustached.user.edit_password.current_password'), array('type' => 'password'), array(array('required')));
    $form->add('password', \Lang::get('mustached.user.edit_password.new_password'), array('type' => 'password'), array(array('required')));
    $form->add('submit', '', array('type' => 'submit', 'value' => \Lang::get('mustached.user.edit_password.action_label'), 'class' => 'btn medium primary'));

    // set the appropriate data for the template
    $this->data['form'] = $form->build();

    if (\Input::method() == 'POST')
    {
      if ($fieldset->validation()->run() == true)
      {
        $fields = $fieldset->validated();
        $auth = \Auth::instance();

        $result = $auth->change_password($fields['current_password'], $fields['password'], $this->current_user['email']);
        if ($result === true)
        {
          $this->data['msg'] = Message::success('mustached.user.edit_password.success');
        }
        else
        {
          $this->data['msg'] = Message::error('mustached.user.edit_password.error');
        }
      }
    }
    return $this->_render('edit_password');
  }


}

