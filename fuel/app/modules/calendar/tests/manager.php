<?php 

namespace Calendar;

/**
 * Message class tests
 *
 * @group Plugin
 * @group Calendar
 */
class Test_Manager extends \TestCase
{

	private $calendarMock;

	public function setUp()
	{
		\Module::load('calendar');

		$this->calendarMock = $this->getMock('Gcalendar', array('getEvents', 'authenticate'));

		$this->calendarMock->expects($this->any())
                      ->method('authenticate')
                      ->will($this->returnValue(true));

        $this->calendarMock->expects($this->any())
                     ->method('getEvents')
                     ->will($this->returnCallback(array($this, 'returnEvents')));
	}

	public function test_get_next_event_has_twenty_event_by_default()
	{
		$m = new Manager($this->calendarMock);
		$e = $m->get_next_events();
		$this->assertSame(20, sizeof($e));
	}

	public function test_get_next_event_with_5_events()
	{
		$m = new Manager($this->calendarMock);
		$e = $m->get_next_events(5);
		$this->assertSame(5, sizeof($e));
	}


	private function createEvents($number)
	{
		$events = new \stdClass;
		$events->data->items = array();
		for($i = 1; $i<($number+1); $i++)
		{
			$events->data->items[] = array('title' => 'Event number '.$i);
		}
		return $events;
	}

	public function returnEvents()
	{
		$args = func_get_args();
		return $this->createEvents($args[1]);
	}

}