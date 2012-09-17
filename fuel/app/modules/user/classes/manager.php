<?php

namespace User;

class Manager
{


	/**
	 * Create a user 
	 * @param  array $datas 	Array of datas containing the user informations : email, password, firstname, lastname, biography, twitter, email, company
	 * @return mixed 		    Return the id of the newly created user on success or an error message on failure   
	 */
	public function create_user($datas)
	{
		$auth = \Auth::instance();
        $id = $auth->create_user($datas['email'], $datas['password'], $datas['email'], $group = 1);
        if($id)
        {
        	$res = $this->update_user($id, $datas);
        	if($res)
        	{
        		return intval($id);
        	}
        	else
        	{
        		return $res;
        	}
        }        
        else 
        {
        	return "Error";
        }
	}

	public function update_user($id, $datas)
    {

    	$user = Model_User::find($id);

    	$user->firstname = isset($datas['firstname']) ? trim($datas['firstname']) : null;
    	$user->lastname  = isset($datas['lastname'])  ? trim($datas['lastname'])  : null;
    	$user->biography = isset($datas['biography']) ? trim($datas['biography']) : null;
    	$user->twitter   = isset($datas['twitter'])   ? trim($datas['twitter'])   : null;
    	$user->email     = isset($datas['email'])     ? trim($datas['email'])     : null;
    	$user->username  = isset($datas['email'])     ? trim($datas['email'])     : null;

    	$datas['company'] =  isset($datas['company']) ? trim($datas['company'])   : null;

    	if($datas['company'] != '')
    	{
    		$c = $this->find_or_create_company($datas['company']);
    		$user->company = $c;
    	}
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


	public function get_users($order = 'asc')
	{
		return \DB::select('users.*')->from('users')->order_by('created_at', $order)->execute()->as_array();		
	}

	public function get_user($id)
	{
		return \DB::select()->from('users')->where('id', '=', $id)->execute()->current();
	}

	/**
	 * Get a specitic user information with expanded datas from other tables
	 * @param  Int 	 	$id     	Id of the user
	 * @param  Array 	$params 	Array of params to expand (values : 'skills', 'company')
	 * @return Array         		Array containing the user information
	 */
	public function get_user_expand($id, $params)
	{
		$u = $this->get_user($id);
		
		foreach($params as $param)
		{
			switch($param)
			{
				case 'skills':
					
					$s = \DB::select('skills.name')					
						->from('users')
						->where('users.id', '=', $id)
						->join('skills_users', 'left')
						->on('skills_users.user_id', '=', 'users.id')
						->join('skills', 'left')
						->on('skills.id', '=', 'skills_users.skill_id')
						->execute()
						->as_array();
					 
					$u['skills'] = $s;
				break;

				case 'company':
					$c = \DB::select('id', 'name')
						->from('companies')			
						->where('companies.id', '=', $u['company_id'])
						->execute()
						->as_array();

					$u['company'] = $c;
				break;
			}			
		}		
		return $u;
	}

	public function get_user_skills($id)
	{
		return \DB::select('skills.name')					
				->from('users')
				->join('skills_users', 'left')
				->on('skills_users.user_id', '=', 'users.id')
				->join('skills', 'left')
				->on('skills.id', '=', 'skills_users.skill_id')
				->order_by('created_at', $order)
				->execute()
				->as_array();
	}

	public function get_skills_by_user()
	{

	}

	public function get_users_here($reason = null)
	{
		$qb = \DB::select('users.*', array('checkins.created_at', 'since'))->from('users')->join('checkins', 'right')->on('checkins.user_id', '=', 'users.id')->where('checkins.killed', '=', '0')->where('checkins.created_at', '>=', date('Y-m-d'))->where('checkins.public', '=', '1');
		if($reason) {
			$qb->where('reason_id', '=', $reason);
		}
		return $qb->execute()->as_array();
	}

	/**
     * Save the user information in session
     * @param string $email     Email of the user
     * @param string $password  Password of the user
     * @return bool|string      Return true on success or the error message on failure
     */
    public function save_user_session($email)
    {
    	try 
    	{
			$u = Model_User::find()->where('email', '=', $email)->get_one();

			$user = array(
	            'user_id'      => $u->id,
	            'firstname'    => $u->firstname,
	            'group'        => $u->group,
	            'email'        => $u->email,
			);

			\Session::set('current_user', $user);
    	}
    	catch (\Exception $e)
        {
            return false;
        }        
        return true;      
    }

    /**
     * Kill the login session
     * @return bool
     */
    public function kill_user_session()
    {
        \Session::delete('current_user');
        return true;
    }



	public function get_companies()
	{
		return \DB::select()->from('companies')->execute()->as_array();
	}

	public function get_company($id)
	{
		return \DB::select()->from('companies')->where('id', '=', $id)->execute()->as_array();
	}

	public function get_occupied_seats_count()
	{
		return \DB::select('users.id')
					->from('users')
					->join('checkins', 'right')
					->on('checkins.user_id', '=', 'users.id')
					->where('checkins.killed', '=', '0')
					->where('checkins.created_at', '>=', date('Y-m-d'))
					->where('checkins.reason_id', '=', 1)
					->execute()
					->count();
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

}
