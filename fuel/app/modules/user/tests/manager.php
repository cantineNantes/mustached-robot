<?php 

namespace User;

/**
 * Manager class tests
 *
 * @group App
 * @group User
 */
class Test_Manager extends \TestCase
{

	private $manager;
	private $user;

	public function setUp()
	{
		\Module::load('user');

		$this->user = array(
			'email'     => 'jeremie.pottier@test.com',
			'firstname' => 'Jérémie',
			'lastname'  => 'Pottier',
			'password'  => 'topsecret',
		);

        $this->manager = new Manager();

	}

	public function tearDown()
	{
		$query = \DB::delete('users')
					->where('email', 'like', '%test.com%')
					->execute();
	}


	/**
	 * @group DB_Cnx
	 */
	public function test_empty_company_still_insert_user()
	{
		$this->user['company'] = '';
		$return = $this->manager->create_user($this->user);
		$this->assertSame(true, $return);
	}

	/**
     * 	@group DB_Cnx
     * 	@expectedException Auth\SimpleUserUpdateException
     */
	public function test_cannot_enter_two_email_addresses()
	{
		$this->manager->create_user($this->user);
		$this->manager->create_user($this->user);		
	}

	/**
     * 	@group DB_Cnx
     */
	public function test_update_user_with_partial_information()
	{		
		$user_id = $this->manager->create_user($this->user);

		unset($this->user['email']); 
		unset($this->user['lastname']); 

		$this->user['firstname'] = 'Jey';

		$this->manager->update_user($user_id, $this->user);
		$new_user = $this->manager->get_user($user_id);

		$this->assertSame('Jey', $new_user['firstname']);
		$this->assertSame('Pottier', $new_user['lastname']);

	}



	

}