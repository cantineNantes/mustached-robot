<?php

/**
 * Authentication system for Mustached Robot
 *
 * This class is used to handle authentication and basic user management (CRUD) in Mustached Robot
 * It DOES NOT follow FuelPHP Auth package (and this is bad) - http://docs.fuelphp.com/packages/auth/intro.html
 *
 * To get an authenticated user's data you can access the following informations :
 *
 * $this->current_user['user_id']   : user's id
 * $this->current_user['firstname'] : user's firstname
 * $this->current_user['is_admin']  : wether the user is an admin or not
 *
 * To check if a user is authenticated, just check if $this->current_user is set :
 * if ($this->current_user)
 * {
 *    echo 'user logged';
 *  }
 */


namespace User;

class Auth {

	private $salt;

    public function __construct()
    {
    	$this->salt = \Config::get('mustached.salt');
    }

    public function create_user($firstname, $lastname, $email, $password, $twitter, $company)
    {
        $user = new Model_User;
        if (!$this->email_exists($email))
        {
            return $this->create_or_update_user($user, $firstname, $lastname, $email, $password, $twitter, $company);
        }
        else
        {
            return \Lang::get('mustached.user.email_exists');
        }
    }

    public function update_user($id, $firstname, $lastname, $email, $twitter, $company)
    {
        $user = Model_User::find($id);

        if (!$this->email_exists($email, $user->email))
        {
            return $this->create_or_update_user($user, $firstname, $lastname, $email, null, $twitter, $company);
        }
        else
        {
            return \Lang::get('mustached.user.email_exists');
        }
    }

    private function create_or_update_user($user, $firstname, $lastname, $email, $password, $twitter, $company)
    {
        $c = $this->find_or_create_company($company);

        $user->firstname = $firstname;
        $user->lastname  = $lastname;
        $user->email     = $email;
        if ($password)
        {
            $user->password  = $this->_prep_password($password);
        }
        $user->twitter   = $twitter;
        $user->company   = $c;

        try
        {
            $user->save();
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
        return true;
    }



    /**
     * Login a user after having verified his credentials
     * @param string $email     Email of the user
     * @param string $password  Password of the user
     * @return bool|string      Return true on success or the error message on failure
     */
    public function login($email, $password)
    {
        $u = Model_User::find()->where('email', '=', $email)->get_one();
        if ($u)
        {

            if ($u->password == $this->_prep_password($password))
            {
                $user = array(
                    'user_id'      => $u->id,
                    'firstname'    => $u->firstname,
                    'is_admin'     => $u->is_admin,
                    'email'        => $u->email,
                );

                \Session::set('current_user', $user);

                return true;
            }
        }
        return false;
    }


    /**
     * Kill the login session
     * @return bool
     */
    public function logout()
    {
        \Session::delete('current_user');
        return true;
    }


    /**
     * Update a user's password with a verification of the current password
     * @param int $id                   Id of the user
     * @param string $current_password  Current password
     * @param strub $new_password       New password
     * @return bool|string              Return true on success or a string containing the message error on failure
     */
    public function update_password($id, $current_password, $new_password)
    {
        $u = Model_User::find($id);
        if($this->_prep_password($current_password) == $u->password)
        {
            $u->password = $this->_prep_password($new_password);
            $u->save();
            return true;
        }
        else {
            return 'mustached.user.edit_password.error';
        }
    }

    /**
     * Utility function to return a company (and if company doesn't exist, this function creates it)
     * @param string company_name   The name of the company to find or create
     * @return null|Model_Company   Return the company or null if the data submitted was empty (no need to create a company in this case)
     */
    public function find_or_create_company($company_name)
    {
        if ($company_name != '')
        {
            $c = Model_Company::find()->where('name', '=', $company_name)->get_one();

            if(!$c)
            {
                $c = new Model_Company;
                $c->name = $company_name;
                $c->save();
            }
            return $c;
        }
        else
        {
            return null;
        }
    }


    /**
     * Check if an email already exists in the database
     *
     * @param string $email     Email to check
     * @param string $exclude   Exclude this email from the search (optionnal, default = null)
     * @return bool             Return true if the user exists, false otherwise
     */
    public function email_exists($email, $exclude = null)
    {
 		return false;
    }


    /**
     * Prepare a password with encryption
     * @param string $password Clear password (as submitted by the user)
     * @return string          Encrypted password
     */
    private function _prep_password($password)
    {
    	return sha1($password.$this->salt);
    }
}
