<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class SchedulersJobs_Failure
{
	function Failure($bean, $event, $arguments) {
		
		$schedAlert = BeanFactory::getBean('sched_SchedulerAlerts');
		$schedAlert->process($bean, $event, $arguments);
		
	}
}