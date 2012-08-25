<?php 

use Mustached\Message;

class Test_Message extends TestCase
{

	private $_generic = array();
	private $_error;
	private $_success;

	public function setUp()
	{
		$this->_generic  = Message::generic('error', 'Error message');
		$this->_error    = Message::error('Error message');                                                    
		$this->_success  = Message::success('Success message');                            
	}	

	/**
 	 * @group App
 	 */
    public function test_message_return_right_keys()
    {
    	$this->assertArrayHasKey('type',    $this->_generic);
    	$this->assertArrayHasKey('content', $this->_generic);
    }	

    /**
     * @group App
     */
    public function test_message_without_translation_return_plain_content()
	{
    	$this->assertSame($this->_generic['content'], 'Error message');
    }

	/**
	 * @group App
	 */
    public function test_message_with_translation_return_translated_content()
	{
		$generic_translated = Message::generic('error', 'mustached.user.login.error');
    	$this->assertSame($generic_translated['content'], \Lang::get('mustached.user.login.error'));
    }


}