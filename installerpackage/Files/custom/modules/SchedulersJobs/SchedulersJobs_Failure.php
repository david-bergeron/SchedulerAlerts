<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'modules/sched_SchedulerAlerts/Classes/sched_Utils.php';
require_once 'modules/sched_SchedulerAlerts/SchedulerAlertsSettings.php';
require_once 'include/SugarPHPMailer.php';
require_once 'modules/Administration/Administration.php';

class SchedulersJobs_Failure
{
	function Failure($bean, $event, $arguments) {
		
		$module   = 'sched_SchedulerAlerts';
		$utils    = new sched_Utils();
		
		$statuses = array('Active'=>'Active', 'Inactive'=>'Inactive');
		$users    = $utils->getUsers();
		$teams    = $utils->getTeams();
		$roles    = $utils->getRoles();
		
		$settings = new SchedulerAlertsSettings($statuses, $users, $teams, $roles);
		
		if ($settings->status->value == "Inactive") {
			$GLOBALS['log']->debug("The SchedulerAlerts module is disabled");
			echo "Inactive";
			exit;
		}
		
		$userNames = array();
		$teamNames = array();
		$roleNames = array();		
		$emails    = array();
		
		// get the users emails and names
		$utils->getEmailsAndNames($settings->users->value, 'Users', &$userNames, &$emails);
		$utils->getEmailsAndNames($settings->teams->value, 'Teams', &$teamNames, &$emails);
		$utils->getEmailsAndNames($settings->roles->value, 'Roles', &$roleNames, &$emails);
		
		$teamNames   = array_unique($teamNames);
		$roleNames   = array_unique($roleNames);
		$emails      = array_unique($emails);
		
		if (count($emails) == 0) {
			$GLOBALS['log']->debug("There are No Emails set up for the SchedulerAlerts module.");
			echo "no emails";
			exit;
		}
		
		$teamNameStr = implode(", ", array_values($teamNames));
		$roleNameStr = implode(", ", array_values($roleNames));
		$userNameStr = implode(", ", array_values($userNames));
		
		$schedAlerts                   = BeanFactory::getBean($module);
		$schedAlerts->name             = $bean->name;
		$schedAlerts->assigned_user_id = $bean->assigned_user_id;
		$schedAlerts->date_entered     = date('Y-m-d H:i:s');
		$schedAlerts->deleted          = 0;
		$schedAlerts->description      = translate($bean->name.' has failed to complete.');
		$schedAlerts->scheduler_status = $bean->status;
		$schedAlerts->scheduler_resolution = 'failure';
		$schedAlerts->team_name        = $teamNameStr;
		$schedAlerts->role_name        = $roleNameStr;
		$schedAlerts->user_name        = $userNameStr;
		$schedAlerts->schedulers_id    = $bean->scheduler_id;
		$schedAlerts->save();
		
		$mailer = new SugarPHPMailer();

		foreach ($emails as $address => $name) {
			$mailer->AddAddress($address, $name);
		}
		
		$mailer->Subject  = translate($bean->name.' has failed to complete.');
		$mailer->Body     = '<b>'.translate($bean->name.' has failed to complete and requires immediate attention.').'</b>';
		$mailer->AltBody  = translate($bean->name.' has failed to complete and requires immediate attention.');
		
		$mailer->prepForOutbound();
		
		// set system default mailer
		$admin            = new Administration();
		$admin->retrieveSettings();
		$mailer->setMailerForSystem();
		
		$mailer->From     = $admin->settings['notify_fromaddress'];
		$mailer->FromName = $admin->settings['notify_fromname'];
		
		if (!$mailer->Send()) {
			$GLOBALS['log']->fatal('Error sending e-mail: ' . $mail->ErrorInfo);
		}
	}
}
