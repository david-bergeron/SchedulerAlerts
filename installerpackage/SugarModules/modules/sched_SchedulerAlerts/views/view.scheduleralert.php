<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
* Agreement ("License") which can be viewed at
* http://www.sugarcrm.com/crm/master-subscription-agreement
* By installing or using this file, You have unconditionally agreed to the
* terms and conditions of the License, and You may not use this file except in
* compliance with the License. Under the terms of the license, You shall not,
* among other things: 1) sublicense, resell, rent, lease, redistribute, assign
* or otherwise transfer Your rights to the Software, and 2) use the Software
* for timesharing or service bureau purposes such as hosting the Software for
* commercial gain and/or for the benefit of a third party. Use of the Software
* may be subject to applicable fees and any use of the Software without first
* paying applicable fees is strictly prohibited. You do not have the right to
* remove SugarCRM copyrights from the source code or user interface.
*
* All copies of the Covered Code must include on each user interface screen:
* (i) the "Powered by SugarCRM" logo and
* (ii) the SugarCRM copyright notice
* in the same form as they appear in the distribution. See full license for
* requirements.
*
* Your Warranty, Limitations of liability and Indemnity are expressly stated
* in the License. Please refer to the License for the specific language
* governing these rights and limitations under the License. Portions created
* by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
********************************************************************************/

require_once 'include/MVC/View/SugarView.php';
require_once 'modules/Teams/Team.php';
require_once 'modules/sched_SchedulerAlerts/Classes/sched_Utils.php';

class ViewSchedulerAlert extends SugarView {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::SugarView();
	}
	
	/**
	 * display the form
	 */
	public function display() {
		global $current_user, $sugar_config, $mod_strings, $app_strings;
		
		if(!is_admin($current_user)) 
			sugar_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
		
		$utils    = new sched_Utils();
		
		$statuses = array('Active'=>'Active', 'Inactive'=>'Inactive');
		$users    = $utils->getUsers();
		$teams    = $utils->getTeams();
		$roles    = $utils->getRoles();
		
		require_once 'modules/sched_SchedulerAlerts/SchedulerAlertsSettings.php';
		$settings = new SchedulerAlertsSettings($statuses, $users, $teams, $roles);
		
		// save the current settings
		if (isset($_POST['button']) && $_POST['button'] == 'Save') {
			if (isset($_POST['alertUser'])) {
				$settings->users->value = $_POST['alertUser'];
			}
			if (isset($_POST['alertTeam'])) {
				$settings->teams->value = $_POST['alertTeam'];
			}
			if (isset($_POST['alertRole'])) {
				$settings->roles->value = $_POST['alertRole'];
			}
			if (isset($_POST['status'])) {
				$settings->status->value = $_POST['status'];
			}
			$settings->save();
			
			if (!headers_sent) {
				header('Location: index.php?module=Administration&action=index');
			} else {
				echo '<script type="text/javascript">';
				echo 'window.location.href="index.php?module=Administration&action=index";';
				echo '</script>';
				echo '<noscript>';
				echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
				echo '</noscript>';
			}
		}

		// set up the status flag
		$statusOpts  = '<select name="status">';
		$statusOpts .= $utils->createOptions($statuses, $settings, 'status');
		$statusOpts .= '</select>';
		
		// Setup the Users data
		$userOpts  = '<select id="alertUser" name="alertUser[]" multiple="true" size="10" style="width: 200px;">';
		$userOpts .= $utils->createOptions($users, $settings, 'users');
		$userOpts .= '</select>';
		
		// Setup the Teams data
		$teamOpts  = '<select id="alertTeam" name="alertTeam[]" multiple="true" size="10" style="width: 200px;">';
		$teamOpts .= $utils->createOptions($teams, $settings, 'teams');
		$teamOpts .= '</select>';
		
		// Setup the Roles data
		$roleOpts  = '<select id="alertRole" name="alertRole[]" multiple="true" size="10" style="width: 250px;">';
		$roleOpts .= $utils->createOptions($roles, $settings, 'roles');
		$roleOpts .= '</select>';
		
		$statLabel = translate('Status: ');
		$teamLabel = translate('Teams: ');
		$userLabel = translate('Users: ');
		$roleLabel = translate('Role: ');
		$modLabel  = translate('LBL_LIST_FORM_TITLE');

		$html = <<<HTML
		<div class="moduleTitle">
			<h2>$modLabel</h2>
		</div>
		<div class="clear"></div>
		<form id="SchedulerAlerts" name="SchedulerAlerts" method="POST" action="index.php?module=sched_SchedulerAlerts&action=SchedulerAlert">
			<table id="SchedulerAlertsTable" style="width: 75%; height: 100%">
				<tr>
					<td valign="top" scope="col">$statLabel</td>
					<td height="100%" valign="top">$statusOpts</td>
				</tr>
				<tr>
					<td valign="top" scope="col">$userLabel</td>
					<td height="100%" valign="top">$userOpts</td>
				
					<td valign="top" scope="col">$teamLabel</td>
					<td height="100%" valign="top">$teamOpts</td>
				
					<td valign="top" scope="col">$roleLabel</td>
					<td height="100%" valign="top">$roleOpts</td>
				<tr>
			</table>
			<div class="clear"></div>
			<table>
				<tr>
					<td width="100%">
						<div class="action_buttons">
							<input id="SAVE_HEADER" class="button primary" type="submit" value="Save" name="button" onclick="var _form = document.getElementById('SchedulerAlerts'); _form.action.value='Save'; if(check_form('SchedulerAlerts'))SUGAR.ajaxUI.submitForm(_form);return false;" accesskey="a" title="Save">
							<div class="clear"></div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		</form>
HTML;
		
		$html .= "</table>";
		
		echo $html;
	}
}