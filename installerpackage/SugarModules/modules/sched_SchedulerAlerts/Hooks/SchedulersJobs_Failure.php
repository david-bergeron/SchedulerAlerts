<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'modules/sched_SchedulerAlerts/sched_SchedulerAlerts.php';

class SchedulersJobs_Failure
{
	function Failure($bean, $event, $arguments) {
		
		$schedAlert = new sched_SchedulerAlerts();
		$schedAlert->process($bean, $event, $arguments);
		
	}
}