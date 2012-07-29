<?php

namespace User;

class Form {

    /**
     * Create a user from the data submitted by a user with a form.
     * @param \Fieldset $fieldset   The fieldset submited by the user containing the user's data
     * @return bool|string          Return true on success, or the error message on failure
     */
	public function create_user_from_form($fieldset)
    {
    	return $this->create_or_update_from_form(null, $fieldset);
    }

    /**
     * Update a user from the data submitted by a user with a form.
     * @param \Fieldset $Fieldset   The fieldset submited by the user containing the user's data
     * @return bool|string          Return true on success, or the error message on failure
     */
    public function update_user_from_form($id, $fieldset)
    {
    	return $this->create_or_update_from_form($id, $fieldset);
    }

    /**
	  *	Create and optionnaly populate a full Fieldset object according to the Model properties and extended properties
	  *	@param integer $id     Id of the user
      * @param string $email   Email to populate the form
	  *	@return \Fieldset      The complete fieldset with additional data and submit button
      */
    public function create_form($id = null, $email = null)
    {
    	$input = \Lang::get('mustached.user.form.add');
        if ($id)
        {

        	$input = \Lang::get('mustached.user.form.edit');

            $fieldset = \Fieldset::forge()->add_model('User\Model_User', '', 'set_edit_fields' );
			$fieldset->add('company', \Lang::get('mustached.user.company'), array('type' => 'text', 'id' => 'companies'));

            $u = \DB::select('firstname', 'email', 'lastname', 'twitter', array('companies.name', 'company'))->from('users')->where('users.id', '=', $id)->join('companies', 'RIGHT')->on('companies.id', '=', 'users.company_id')->execute()->current();

           $user = array(
            	'firstname' => $u['firstname'],
            	'email'     => $u['email'],
            	'lastname'  => $u['lastname'],
            	'twitter'   => $u['twitter'],
            	'company'   => $u['company'],
			);

            $fieldset->populate($user, true);
        }
        else {
            $fieldset = \Fieldset::forge()->add_model('User\Model_User', '', 'set_add_fields');
            if($email) {
                $fieldset->populate(array('email' => $email, true));
            }
            $fieldset->add('company', \Lang::get('mustached.user.company'), array('type' => 'text', 'id' => 'companies'));
        }

        $fieldset->add('submit', '', array('type' => 'submit', 'value' => $input, 'class' => 'btn medium primary'));
        $fieldset->repopulate();

        return $fieldset;
    }


    private function create_or_update_from_form($id, $fieldset)
    {
    	$auth = new Auth;

    	if ($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            if($id)
            {
            	return $auth->update_user($id, $fields['firstname'], $fields['lastname'], $fields['email'], $fields['twitter'], $fields['company']);
            }
            else
            {
            	return $auth->create_user($fields['firstname'], $fields['lastname'], $fields['email'], $fields['password'], $fields['twitter'], $fields['company']);
            }
        }
        else
        {
            return $fieldset->validation()->error();
        }
        return \Lang::get('mustached.user.save_error');

    }


}
