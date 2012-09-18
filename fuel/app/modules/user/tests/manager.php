<?php 

namespace User;

/**
 * Manager class tests
 *
 * @group App
 * @group User
 * @group DB_Cnx
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


	/*----------------------------------------------
     *
     * TEST USER CREATIONS
     *
     *---------------------------------------------*/


	public function test_create_user_returns_integer()
	{
		$return = $this->manager->create_user($this->user);
		$this->assertInternalType('int', $return);
	}

	/**
     * 	@expectedException Auth\SimpleUserUpdateException
     */
	public function test_cannot_enter_two_email_addresses()
	{
		$this->manager->create_user($this->user);
		$this->manager->create_user($this->user);		
	}

	/**
	 * @group DB_Cnx
	 */
	public function test_empty_company_still_insert_user()
	{
		$this->user['company'] = '';
		$return = $this->manager->create_user($this->user);
		$this->assertInternalType('int', $return);
	}

	/*----------------------------------------------
     *
     * TEST UPDATE USER
     *
     *---------------------------------------------*/

	/**
     * 	@group DB_Cnx
     */
	public function test_update_user_with_partial_information()
	{		
		// Create a user
		$user_id = $this->manager->create_user($this->user);

		// Update it
		$this->user['firstname'] = 'Jey';
		$this->manager->update_user($user_id, $this->user);

		// Get his informations
		$new_user = $this->manager->get_user($user_id);

		// Assertions
		$this->assertSame('Jey', $new_user['firstname']);
		$this->assertSame('Pottier', $new_user['lastname']);
	}

	/*----------------------------------------------
     *
     * TEST USER GETTERS
     *
     *---------------------------------------------*/

	
	public function test_get_user_return_the_right_user()
	{
		$user = $this->manager->get_user(1);

		$this->assertSame('Jérémie', $user['firstname']);
		$this->assertSame('Pottier', $user['lastname']);


		$new_user = $this->manager->get_user(2);
		$this->assertSame('Florent', $new_user['firstname']);
		$this->assertSame('Gosselin', $new_user['lastname']);

	}

	public function test_get_users_return_all_users()
	{

	}

	public function test_get_user_expand_without_param()
	{

	}

	public function test_get_user_expand_skills()
	{
		
	}

	public function test_get_user_expand_company()
	{
		
	}

	public function test_get_user_expand_skills_and_company()
	{
		
	}

	public function test_gest_user_skills()
	{

	}

	public function test_get_users_here_when_no_one()
	{

	}

	public function test_get_users_here_when_someones()
	{
		
	}

	public function test_get_company()
	{
		
	}

	public function test_get_companies()
	{
		
	}

	public function test_create_company()
	{

	}

	public function find_company()
	{

	}

	





	

}