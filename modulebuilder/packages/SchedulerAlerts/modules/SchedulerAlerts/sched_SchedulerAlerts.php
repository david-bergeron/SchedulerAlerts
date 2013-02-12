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
		
		// get the users emails and names
		$utils->getEmailsAndNames($settings->users->value, 'Users', $userNames, $emails);
		$utils->getEmailsAndNames($settings->teams->value, 'Teams', $teamNames, $emails);
		$utils->getEmailsAndNames($settings->roles->value, 'Roles', $roleNames, $emails);
		
		$teamNames   = array_unique($teamNames);
		$roleNames   = array_unique($roleNames);
		$emails      = array_unique($emails);
		
		if (count($emails) == 0) {
			$GLOBALS['log']->debug("LBL_NO_EMAILS", $module);
			return;
		}
		
		$teamNameStr = implode(", ", array_values($teamNames));
		$roleNameStr = implode(", ", array_values($roleNames));
		$userNameStr = implode(", ", array_values($userNames));
		
		$this->name             = $bean->name;
		$this->assigned_user_id = $bean->assigned_user_id;
		$this->description      = $bean->name.' '.translate("LBL_FAILED_TO_COMPLETE", $module);
		$this->scheduler_status = $bean->status;
		$this->scheduler_resolution = translate("LBL_FAILURE", $module);
		$this->team_name        = $teamNameStr;
		$this->role_name        = $roleNameStr;
		$this->user_name        = $userNameStr;
		$this->schedulers_id    = $bean->scheduler_id;
		$this->save();
		
		$mailer           = new SugarPHPMailer();
		foreach ($emails as $address => $name) {
			$mailer->AddAddress($address, $name);
		}
		
		$mailer->Subject  = $bean->name.' '.translate("LBL_FAILED_TO_COMPLETE", $module);
		$mailer->Body     = '<b>'.$bean->name.' '.translate("LBL_NEEDS_ATTENTION", $module).'</b>';
		$mailer->AltBody  = $bean->name.' '.translate("LBL_NEEDS_ATTENTION", $module);
		
		$mailer->prepForOutbound();
		
		// set system default mailer
		$admin            = new Administration();
		$admin->retrieveSettings();
		$mailer->setMailerForSystem();
		
		$mailer->From     = $admin->settings['notify_fromaddress'];
		$mailer->FromName = $admin->settings['notify_fromname'];
		
		if (!$mailer->Send()) {
			$GLOBALS['log']->fatal(translate("LBL_EMAIL_ERROR", $module) . $mailer->ErrorInfo);
		}
	}
	
}
?>