<?php 

namespace Calendar;

/**
 * Manager class tests
 *
 * @group App
 * @group Calendar
 */
class Test_Manager extends \TestCase
{

	private $calendarMock;
	private $manager;

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

        $this->manager = new Manager($this->calendarMock);

	}

	public function test_get_next_event_has_20_events_by_default()
	{
		
		$e = $this->manager->get_next_events();
		$this->assertSame(20, sizeof($e));
	}

	public function test_get_next_5_events_return_5_events()
	{
		$e = $this->manager->get_next_events(5);
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