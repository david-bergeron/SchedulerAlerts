<?php
array_push($job_strings, 'force_job_failure');

function force_job_failure()
{
	return false;
}