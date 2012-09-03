<?php

namespace Checkin;
use Mustached\Message;

class Controller_Admin extends \Controller_Admin
{



	/**
	 * Show a list of the last checkins
	 */
	public function action_index()
	{

		$checkins = Model_Checkin::find('all', array(
				'related'  => array('user', 'reason'),
				'order_by' => array('created_at' => 'desc'),
			));

		foreach($checkins as $c)
		{
			$date = substr($c->created_at, 0, 10);
			$this->data['checkins'][$date][] = array(
				'id'     => $c->id,
				'email'  => $c->user->email,
				'reason' => $c->reason->sentence,
				'start'  => $c->created_at,
				'time_ago' => \Date::time_ago(strtotime($c->created_at)),
				'end'    => $c->updated_at,
				'killed' => $c->killed,
				'user'   => array(
					'name'   => $c->user->firstname.' '.$c->user->lastname,
					'id'     => $c->user->id,
				),
			);
		};

		\Module::load('user');
		$um        = new \User\Manager;
		$total        		     = \Config::get('mustached.seats');

		$this->data['total_seats']     = \Config::get('mustached.seats');
		$this->data['occupied_seats']  = $um->get_occupied_seats_count();
		$this->data['occupation']      = round(($this->data['occupied_seats'] / $this->data['total_seats'] * 100));
		

		return $this->_render('admin');
	}

	/**
	 * Kill a coworker's checkin (to indicate he isn't here anymore)
	 * @param int $id Id of the checkin to kill
	 */
	public function action_kill($id)
	{

		

		$checkin = Model_Checkin::find($id);
		if(!$checkin)
		{
			Message::flash_error('mustached.checkin.doesnt_exist');
		}
		else {
			$checkin->killed = true;
			$checkin->save();
			Message::flash_success('mustached.checkin.killed.success');
		}
		return \Response::redirect('admin');
	}

	/**
	 * Show statistics about the checkins
	 * @param string (yyyy-mm-dd) $start Start of the analytics range (optionnal,  default = 30 days from nom)
	 * @param string (yyyy-mm-dd) $end   End of the analytucs range (optionnal, default = today)
	 */
	public function action_stats($start = null, $end = null)
	{




		$m = new Manager;

		if(!$end)     $end   = date('Y-m-d');
		if(!$start)   $start = date_sub(new \DateTime($end), new \DateInterval('P30D'))->format('Y-m-d');

		$checkins = $m->get_checkins($start, $end);

		$users = array();
    	$days = array();
    	$checkinperday = array();

    	foreach($checkins as $checkin) {
    		$checkin_date = date('Y-m-d',strtotime($checkin['created_at']));

    		// Compute the number of different users
    		if (!in_array($checkin['user_id'], $users))
    		{
    			$users[] = $checkin['user_id'];
    		}

    		// Compute the number of different days
    		if(!in_array($checkin['created_at'], $days))
    		{
    			$days[]  = $checkin['created_at'];
    		}

    		// Compute the number of logs for each day of the range
    		if(array_key_exists($checkin_date, $checkinperday)) {
				$checkinperday[$checkin_date]++;
    		}
    		else
    		{
				$checkinperday[$checkin_date] = 1;
    		}
    	}



		$this->data['dates'] = array(
    		'start' => $start,
    		'end'   => $end
    	);
    	$this->data['count'] = array(
    		'users' => sizeof($users),
    		'days'  => sizeof($days),
    		'logs'  => sizeof($checkins),
    	);
    	$this->data['checkins'] = $checkinperday;

    	return $this->_render('stats');

	}

}
