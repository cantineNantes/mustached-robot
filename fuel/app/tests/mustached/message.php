<?php 

use Mustached\Message;

/**
 * Message class tests
 *
 * @group App
 */
class Test_Message extends TestCase
{

	private $_generic = array();
	private $_error;
	private $_success;

	private $_success_message = 'Success message';
	private $_error_message = 'Error message';

	public function setUp()
	{
		$this->_generic  = Message::generic('error', $this->_error_message);
		$this->_error    = Message::error($this->_error_message);                                                    
		$this->_success  = Message::success($this->_success_message);                            
	}	

    public function test_generic_message_return_right_keys()
    {
    	$this->assertArrayHasKey('type',    $this->_generic);
    	$this->assertArrayHasKey('content', $this->_generic);
    }	

    public function test_generic_message_return_right_values()
    {
    	$this->assertSame($this->_generic['type'], 'error');    	
    	$this->assertSame($this->_generic['content'], $this->_error_message);    	
    }	

    public function test_message_without_translation_returns_plain_content()
	{
    	$this->assertSame($this->_generic['content'], $this->_error_message);
    }

    public function test_message_with_translation_string_returns_translated_content()
	{
		$generic_translated = Message::generic('error', 'mustached.user.login.error');
    	$this->assertSame($generic_translated['content'], \Lang::get('mustached.user.login.error'));
    }

    public function test_success_message_return_success_type()
    {
    	$this->assertSame($this->_success['type'], 'success');
    }

    public function test_success_message_return_right_content()
    {
    	$this->assertSame($this->_success['content'], $this->_success_message);
    }

 	public function test_error_message_return_error_type()
    {
    	$this->assertSame($this->_error['type'], 'error');
    }

    public function test_error_message_return_right_content()
    {
    	$this->assertSame($this->_error['content'], $this->_error_message);
    }

    public function test_flash_success()
    {
    	Message::flash_success($this->_success_message);
    	$this->assertSame(\Session::get_flash('msg'), $this->_success); 
    }

    public function test_flash_error()
    {
    	Message::flash_error($this->_error_message);
    	$this->assertSame(\Session::get_flash('msg'), $this->_error); 
    }



}