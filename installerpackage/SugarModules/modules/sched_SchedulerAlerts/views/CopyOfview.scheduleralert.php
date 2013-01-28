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
		
		// get the Teams data
		$teamsObj  = BeanFactory::newBean('Teams');
		$groupBy   = "name";
		$where     = "associated_user_id != 1 OR associated_user_id IS NULL";
		$teams     = $teamsObj->get_list($groupBy, $where);
		$teamOpts  = '<select name="team">';
		$teamOpts .= '<option value="none" selected></option>';
		$teamList  = array();
		foreach ($teams['list'] as $key => $team) {
			$teamOpts .= '<option value="'.$team->associated_user_id.'">'.$team->name.'</option>';
			$teamList[$team->id] = $team->name;
		}
		$teamOpts .= '</select>';
		
		// get the Users data
		$usersObj  = BeanFactory::newBean('Users');
		$orderBy   = "last_name";
		$where     = "users.status = 'Active' AND users.is_admin=0";
		$users     = $usersObj->get_list($orderBy, $where);
		$userOpts  = '<select name="user">';
		$userOpts .= '<option value="none" selected></option>';
		$usersList = array();
		$emailList = array();
		foreach ($users['list'] as $key => $user) {
			$userOpts .= '<option value="'.$user->id.'">'.$user->last_name;
			if ($user->first_name != '') {
				$userOpts .= ', '.$user->first_name;
			}
			$userOpts .= '</option>';
			$usersList[$user->id] = $user->last_name.', '.$user->first_name;
		}
		$userOpts .= '</select>';
		
		// get the Roles data
		$rolesObj  = BeanFactory::newBean('Roles');
		$roles     = $rolesObj->get_list();
		$roleOpts  = '<select name="role">';
		$roleOpts .= '<option value="none" selected></option>';
		$roleList  = array();
		foreach ($roles['list'] as $role) {
			$roleOpts .= '<option value="'.$role->id.'">'.$role->name.'</option>';
			$roleList[$role->id] = $role->name;
		}
		$roleOpts .= '</select>';
		
		// get the sched_SchedulerAlerts data
		$schedAlerts  = BeanFactory::newBean('sched_SchedulerAlerts');
		$where        = "sched_SchedulerAlerts.deleted = 0";
		$activeAlerts = $schedAlerts->get_list('', $where);
		
// 		echo "<pre>";
// 		print_r($activeAlerts);
// 		echo "</pre>";
		
		$nameLabel = translate('Scheduler Alert Name: ');
		$teamLabel = translate('Teams: ');
		$userLabel = translate('Users: ');
		$roleLabel = translate('Role: ');
		$modLabel  = translate('LBL_MODULE_NAME');
		$modList   = translate('LBL_LIST_FORM_TITLE');
		$userHdr   = translate('Assigned User');
		$nameHdr   = translate('Scheduled Alert Name');
		$teamHdr   = translate('Team');
		$roleHdr   = translate('LBL_ROLE_ID');
		
		$html = <<<HTML
		<div class="moduleTitle">
			<h2>$modLabel</h2>
		</div>
		<div class="clear"></div>
		<form id="SchedulerAlerts" name="SchedulerAlerts" method="POST" action="index.php">
			<table>
				<tr>
					<td width="100%">
						<div class="action_buttons">
							<input id="SAVE_HEADER" class="button primary" type="submit" value="Save" name="button" onclick="var _form = document.getElementById('SchedulerAlerts'); _form.action.value='Save'; if(check_form('SchedulerAlerts'))SUGAR.ajaxUI.submitForm(_form);return false;" accesskey="a" title="Save">
							<input id="CANCEL_HEADER" class="button" type="button" value="Cancel" name="button" onclick="SUGAR.ajaxUI.loadContent('index.php?module=sched_SchedulerAlerts&action=SchedulerAlert'); return false;" accesskey="l" title="Cancel [Ctrl+l]">
							<input id="btn_view_change_log" class="button" type="button" value="View Change Log" onclick="open_popup("Audit", "600", "400", "&record=2eaec982-2c57-f7d3-fd03-50fd7e74ffc3&module_name=sched_SchedulerAlerts", true, false, { "call_back_function":"set_return","form_name":"SchedulerAlerts","field_to_name_array":[] } ); return false;" title="View Change Log">
							<div class="clear"></div>
						</div>
					</td>
				</tr>
			</table>
			<table id="SchedulerAlertsTable" class="view detail" style="width: 50%">
				<tr>
					<td width="12.5%" valign="top" scope="col">$nameLabel</td>
					<td width="37.5%" valign="top"><input id="name" type="text" name="name"></td>
				</tr>
				<tr>
					<td width="12.5%" valign="top" scope="col">$userLabel</td>
					<td width="37.5%" valign="top">$userOpts</td>
				<tr>
				<tr>
					<td width="12.5%" valign="top" scope="col">$teamLabel</td>
					<td width="37.5%" valign="top">$teamOpts</td>
				<tr>
				<tr>
					<td width="12.5%" valign="top" scope="col">$roleLabel</td>
					<td width="37.5%" valign="top">$roleOpts</td>
				<tr>
			</table>
			<table>
				<tr>
					<td width="100%">
						<div class="action_buttons">
							<input id="SAVE_HEADER" class="button primary" type="submit" value="Save" name="button" onclick="var _form = document.getElementById('SchedulerAlerts'); _form.action.value='Save'; if(check_form('SchedulerAlerts'))SUGAR.ajaxUI.submitForm(_form);return false;" accesskey="a" title="Save">
							<input id="CANCEL_HEADER" class="button" type="button" value="Cancel" name="button" onclick="SUGAR.ajaxUI.loadContent('index.php?module=sched_SchedulerAlerts&action=SchedulerAlert'); return false;" accesskey="l" title="Cancel [Ctrl+l]">
							<input id="btn_view_change_log" class="button" type="button" value="View Change Log" onclick="open_popup("Audit", "600", "400", "&record=2eaec982-2c57-f7d3-fd03-50fd7e74ffc3&module_name=sched_SchedulerAlerts", true, false, { "call_back_function":"set_return","form_name":"SchedulerAlerts","field_to_name_array":[] } ); return false;" title="View Change Log">
							<div class="clear"></div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		</form>
		<br />
		<hr />
		<div class="moduleTitle">
			<h2>$modList</h2>
		</div>
		<div class="clear"></div>
		<table id="SchedulerAlertsTable" class="view detail"  style="width: 50%">
			<tr>
				<th>$nameHdr</th>
				<th>$userHdr</th>
				<th>$teamHdr</th>
				<th>$roleHdr</th>
			</tr>
HTML;
		foreach ($activeAlerts['list'] as $activeAlert) {
			$userName = $usersList[$activeAlert->assigned_user_id];
			$roleName = $roleList[$activeAlert->role_id];
			$teamName = $teamList[$activeAlert->team_id];
		$html .=<<<HTML
			<tr>
				<td>$activeAlert->name</td>
				<td>$userName</td>
				<td>$roleName</td>
				<td>$teamName</td>
			</tr>
HTML;
		}
		
		$html .= "</table>";
		
		echo $html;
	}
}