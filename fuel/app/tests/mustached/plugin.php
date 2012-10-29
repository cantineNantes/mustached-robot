<?php 

use Mustached\Plugin;

/**
 * Plugin class tests
 *
 * @group Plugin
 */
class Test_Plugin extends TestCase
{

	private $p;
	private $real_plugins; // real plugins;

	public function setUp()
	{
		$this->p = new Plugin;
		$this->real_plugins = $this->p->get_plugins();

		$this->p->set_plugins(array('test'));
		
	}


	public function test_get_plugins()
	{
		$p = new Plugin;
		$expected_plugins = array('twitter');
		$result_plugins    = $p->get_plugins();
		$this->assertEquals($expected_plugins, $result_plugins);
	}

	public function test_post_checkin_triggers_the_plugins()
	{
		// use the fake test plugin
		$res = $this->p->pluginAction('Trigger', 'postCheckin');
		$this->assertEquals(true, $res['test']);
	}

	public function test_post_checkin_send_params()
	{
		// use the fake test plugin
		$res = $this->p->pluginAction('Trigger', 'postCheckin', array('return' => 'returnValue'));
		$this->assertEquals('returnValue', $res['test']);
	}

	public function test_add_element_on_public_checkin()
	{
		
		$p = new Plugin;

		$fieldset = \Fieldset::forge('checkin');
		$fieldset->add('reason', '', array('type' => 'text'), array());

		$res = $p->addToForm('publicCheckin', $fieldset);

		$new_field = $res->field('twitter');

		$field = new Fuel\Core\Fieldset_Field('test');

		$this->assertInstanceOf('Fuel\Core\Fieldset', $res);

	}


	/**
	 * Test on each real plugin if the addElementOnPublicCheckin is correctly configured
	 */
	public function test_add_element_on_public_checkin_has_right_values_and_types()
	{		
		foreach($this->real_plugins as $p)
		{
			\Module::load($p);
			$object_name = "\\".ucfirst($p)."\Form";
			$object = new $object_name;

			if(method_exists($object, 'addElementOnPublicCheckin'))
			{
				$r = $object->addElementOnPublicCheckin();
				$this->assertArrayHasKey('before_after', $r);
				$this->assertArrayHasKey('name',         $r);
				$this->assertArrayHasKey('label',        $r);
				$this->assertArrayHasKey('attributes',   $r);
				$this->assertArrayHasKey('rules',        $r);
				$this->assertArrayHasKey('fieldname',    $r);

				$this->assertInternalType('string', $r['before_after']);
				$this->assertInternalType('string', $r['name']);
				$this->assertInternalType('string', $r['label']);
				$this->assertInternalType('array',  $r['attributes']);
				$this->assertInternalType('array',  $r['rules']);
				$this->assertInternalType('string', $r['fieldname']);
			}
		}
	} 




}