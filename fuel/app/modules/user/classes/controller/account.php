<?php

namespace User;
use Mustached\Message;

class Controller_Account extends \Controller_Front
{

  public function before()
  {
     parent::before();
  }

	public function action_index()
  {
    /*
    echo date('Y-m-d');
    $return = array('checkins.id', 'checkins.reason_id', 'users.firstname', 'users.lastname', 'users.email', 'users.twitter', 'users.company_id', 'users.created_at', 'users.updated_at', 'checkins.created_at');
    $r = \DB::select_array($return)->from('users')->join('checkins', 'right')->on('checkins.user_id', '=', 'users.id')->where('checkins.killed', '=', '0')->where('checkins.created_at', '>=', date('Y-m-d'))->where('checkins.public', '=', '1')->execute()->as_array(); // ->
    */

    $um = new Manager;
    $r = $um->get_users_here();

    echo '<pre>';
      print_r($r);
    echo '</pre>';

    return $this->_render('add');

  }


  public function action_add()
  {

    $fm = new Form;
    $fieldset = $fm->create_form(null, urldecode(\Input::get('email')));

    $this->data['form'] = $fieldset->form()->build();

    // If the form is submitted and the data are valid
    if(\Input::method() == 'POST')
    {
        $result = $fm->create_user_from_form($fieldset);
        if($result === true)
        {
           $this->data['msg'] = Message::success('mustached.user.save_success');
        }
        else
        {
           $this->data['msg'] = Message::error($result);
        }
    }

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

        // If the form is submitted and the data are valid
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


    // repopulate the form on errors
    $fieldset->repopulate();

    // set the appropriate data for the template
    $this->data['form'] = $form->build();

    if (\Input::method() == 'POST')
    {
      if ($fieldset->validation()->run() == true)
      {
        $fields = $fieldset->validated();
        $auth = new Auth;

        $result = $auth->update_password($this->current_user['user_id'], $fields['current_password'], $fields['password']);
        if ($result === true)
        {
          $this->data['msg'] = Message::success('mustached.user.edit_password.success');
        }
        else
        {
          $this->data['msg'] = Message::error($result);
        }
      }
    }
    return $this->_render('edit_password');
  }


}

