<?php

$hook_version = 1;
$hook_array = Array();

$hook_array['job_failure'][] = Array();
$hook_array['job_failure'][] = Array(
	99, 
	'job_failure example', 
	'modules/sched_SchedulerAlerts/Hooks/SchedulersJobs_Failure.php',
	'SchedulersJobs_Failure',
	'Failure'
);
