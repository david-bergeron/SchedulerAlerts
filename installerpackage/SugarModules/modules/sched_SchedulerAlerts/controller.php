<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class sched_SchedulerAlertsController extends SugarController {

	function action_SchedulerAlert() {
		$this->view = 'scheduleralert';
	}

}