<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends Admin_Controller {

	public function index()
	{
		
	}


	/*
	 * This controller return a view with analytics data for the coworking space
	 * Without argument, the page show the datas for a date range going from now to one month ago
	 * With a first argument ($start, format yyyy-mm-dd), the page shows the data from this date to now
	 * With two argument ($start and $end, both format yyyy-mm-dd), the page shows datas from $start date to $end date
	 */

	public function range($start = null, $end = null)
	{

		if(!$end)     $end   = date('Y-m-d');
		if(!$start)   $start = date_sub(new DateTime($end), new DateInterval('P30D'))->format('Y-m-d');
		
		$logs = new Log();
    	$logs->where('created >=', $start);
    	$logs->where('created <=', $end); 
		$logs->get();

    	$users = array();
    	$days = array();
    	$logperday = array();
    	foreach($logs as $log) {
    		$log_date = date('Y-m-d',strtotime($log->created));

    		// Compute the number of different users
    		if(!in_array($log->user_id, $users)) $users[] = $log->user_id;

    		// Compute the number of different days
    		if(!in_array($log->created, $days))  
    		{ 
    			$days[]  = $log->created;
    		}

    		// Compute the number of logs for each day of the range
    		if(array_key_exists($log_date, $logperday)) {
				$logperday[$log_date]++;
    		}		
    		else 
    		{
				$logperday[$log_date] = 1;
    		}
    	}

    	$data = array(
    		'dates' => array(
    			'start' => $start,
    			'end'   => $end
    		),
    		'count' => array(
    			'users' => sizeof($users),
    			'days'  => sizeof($days),
    			'logs'  => $logs->count()
    		),
    		'logs' => $logperday
    	);

    	$this->_render('analytics', $data);
	}
}
