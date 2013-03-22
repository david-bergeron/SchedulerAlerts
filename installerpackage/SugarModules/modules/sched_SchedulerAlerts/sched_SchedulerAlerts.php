<?PHP
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once 'modules/sched_SchedulerAlerts/sched_SchedulerAlerts_sugar.php';
require_once 'modules/sched_SchedulerAlerts/Classes/sched_Utils.php';
require_once 'modules/sched_SchedulerAlerts/SchedulerAlertsSettings.php';
require_once 'modules/Administration/Administration.php';
require_once 'include/SugarPHPMailer.php';

class sched_SchedulerAlerts extends sched_SchedulerAlerts_sugar {
	
	function sched_SchedulerAlerts(){	
		parent::sched_SchedulerAlerts_sugar();
	}
	
	public function process($bean, $event, $arguments) {

		$module   = 'sched_SchedulerAlerts';
		$utils    = new sched_Utils();
		
		$settings = new SchedulerAlertsSettings();
		
		if ($settings->status->value == "Inactive") {
			$GLOBALS['log']->debug("LBL_MODULE_DISABLED", $module);
			return;
		}
		
		$userNames = array();
		$teamNames = array();
		$roleNames = array();
		$emails    = array();
		$userIds   = array();
		
		// get the users emails and names
		$utils->getEmailsAndNames($settings->users->value, 'Users', $userNames, $emails);
		$utils->getEmailsAndNames($settings->teams->value, 'Teams', $teamNames, $emails);
		$utils->getEmailsAndNames($settings->roles->value, 'Roles', $roleNames, $emails);

		foreach ($userNames as $id => $name) {
			array_push($userIds, $id);
		}
		foreach ($teamNames as $id => $name) {
			array_push($userIds, $id);
		}
		foreach ($roleNames as $id => $name) {
			array_push($userIds, $id);
		}
		
		$teamNames = $utils->getTeamNames($settings->teams->value);
		$roleNames = $utils->getRoleNames($settings->roles->value);
		$emails    = array_unique($emails);

		if (count($emails) == 0) {
			$GLOBALS['log']->debug("LBL_NO_EMAILS", $module);
			return;
		}

		$userNameStr = implode(", ", array_values($userNames));
		
		$this->name             = $bean->name;
		$this->assigned_user_id = $bean->assigned_user_id;
		$this->description      = $bean->name.' '.translate("LBL_FAILED_TO_COMPLETE", $module);
		$this->scheduler_status = $bean->status;
		$this->scheduler_resolution = translate("LBL_FAILURE", $module);
		$this->team_set_id      = $bean->team_set_id;
		$this->team_names       = $teamNames;
		$this->role_names       = $roleNames;
		$this->user_names       = $userNameStr;
		$this->schedulers_id    = $bean->scheduler_id;
		$this->save();
		
		$this->load_relationship('sched_scheduleralerts_users');
		foreach ($userIds as $userId) {
			$this->sched_scheduleralerts_users->add($userId);
		}
		
		$jobDate   = TimeDate::getInstance()->to_display_date_time($bean->execute_time);
		
		global $sugar_config;
		$baseLink  = trim($sugar_config['site_url']);
		$extLink   = "index.php?action=DetailView&module=Schedulers&record={$bean->scheduler_id}";
		
		$slash     = '';
		if ($baseLink[strlen($baseLink)-1] != '/')
		{
			$slash = '/';
		}
		
		$schedulerLink = "{$baseLink}{$slash}{$extLink}";
		
		// set system default mailer
		$admin         = new Administration();
		$admin->retrieveSettings();

		foreach ($emails as $address => $name) {
			
			$mailer           = new SugarPHPMailer();
			$mailer->AddAddress($address, $name);
		
			$message       = translate("LBL_DESCRIPTION_1", $module);
			$schedulerName = translate("LBL_DESCRIPTION_2", $module);
			$jobStarted    = translate("LBL_DESCRIPTION_3", $module);
			$record        = translate("LBL_DESCRIPTION_4", $module);

			$descriptionHtml  = $name.',<br /><br />';
			$descriptionHtml .= $message.'<br /><br />';
			$descriptionHtml .= $schedulerName.$bean->name.'<br />';
			$descriptionHtml .= $jobStarted.$jobDate.'<br /><br />';
			$descriptionHtml .= $record.'<a href="'.$schedulerLink.'">';
			$descriptionHtml .= $schedulerLink.'</a>';

			$mailer->Subject  = translate("LBL_EMAIL_SUBJECT", $module);
			$mailer->Body     = translate($descriptionHtml, $module);
			$mailer->AltBody  = translate($descriptionHtml, $module);
			
			$mailer->prepForOutbound();
			
			$mailer->setMailerForSystem();
			
			$mailer->From     = $admin->settings['notify_fromaddress'];
			$mailer->FromName = $admin->settings['notify_fromname'];
			
			if (!$mailer->Send()) {
				$GLOBALS['log']->fatal(translate("LBL_EMAIL_ERROR", $module) . $mailer->ErrorInfo);
				error_log("Email Send Failed: ".$mailer->ErrorInfo);
			}
		}
	}
}
