<?php
$admin_options_defs=array();
$admin_options_defs['Administration']['Section_Key']=array(
		'Administration',
		'Scheduler Alerts',
		'Scheduler Failed Alerts',
		'./index.php?module=sched_SchedulerAlerts&action=SchedulerAlert'
);
$admin_group_header[] = array('Scheduler Alerts', '', false, $admin_options_defs);
