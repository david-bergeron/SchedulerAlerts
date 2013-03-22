<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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

/*********************************************************************************

* Description:
********************************************************************************/

class sched_Utils
{
	public function getUsers() {
		// get the Users data
		$usersObj  = BeanFactory::newBean('Users');
		$orderBy   = "last_name";
		$where     = "users.status = 'Active'";
		$users     = $usersObj->get_list($orderBy, $where);
	
		$return = array();
		foreach ($users['list'] as $user) {
			$return[$user->id] = $user->last_name;
				
			if ($user->first_name != '') {
				$return[$user->id] .= ', '.$user->first_name;
			}
		}
		return $return;
	}
	
	public function getTeams() {
		// get the Teams data
		$teamsObj  = BeanFactory::newBean('Teams');
		$orderBy   = "name";
		$teams     = $teamsObj->get_list($orderBy);
	
		$return = array();
		foreach ($teams['list'] as $team) {
			$return[$team->id] = $team->name;
		}
		return $return;
	}
	
	public function getTeamNames($teams) {
		// get the Teams data
		$teamsObj  = BeanFactory::newBean('Teams');
		$where     = " id IN ('".implode("', '", $teams)."')";
		$orderBy   = "";
		$teams     = $teamsObj->get_list($orderBy, $where);
	
		$return = array();
		foreach ($teams['list'] as $team) {
			$return []= $team->name;
		}
		return implode(', ', $return);
	}
	
	public function getRoles() {
		// get the Roles data
		$rolesObj  = BeanFactory::newBean('ACLRoles');
		$roles     = $rolesObj->get_list();
	
		$return = array();
		foreach ($roles['list'] as $role) {
			$return[$role->id] = $role->name;
		}
		return $return;
	}
	
	public function getRoleNames($roles) {
		// get the Teams data
		$rolesObj  = BeanFactory::newBean('ACLRoles');
		$where     = " id IN ('".implode("', '", $roles)."')";
		$orderBy   = "";
		$roles     = $rolesObj->get_list($orderBy, $where);
	
		$return = array();
		foreach ($roles['list'] as $team) {
			$return []= $team->name;
		}
		return implode(', ', $return);
		
	}
	
	public function createOptions($elements, $settings, $name) {
		$return = '';
		foreach ($elements as $id => $element) {
			if (is_array($settings->$name->value) && in_array($id, $settings->$name->value)) {
				$return .= '<option value="'.$id.'" selected>'.$element.'</option>';
			} elseif (!is_array($settings->$name->value) && $element == $settings->$name->value) {
				$return .= '<option value="'.$id.'" selected>'.$element.'</option>';
			} else {
				$return .= '<option value="'.$id.'">'.$element.'</option>';
			}
		}
		return $return;
	}
	
	public function getEmailsAndNames($array, $module, &$names, &$emails) {
		global $utils;
		
		foreach ($array as $id) {
			if ($module == 'Users') {
				// gets a User object
				$bean  = BeanFactory::getBean($module, $id);
			} elseif ($module == 'Teams') {
				// gets an array of Team objects
				$bean  = $this->getUsersInTeams($id);
				$team  = BeanFactory::getBean($module, $id);
			} elseif ($module == 'Roles') {
				// gets an array of Role objects
				$bean  = $this->getUsersInRoles($id);
				$role  = BeanFactory::getBean('ACLRoles', $id);
			}
				
			if (is_array($bean)) {
				foreach ($bean as $user) {
					if (strlen($user->email1) > 0) {
						$emails[$user->email1] = $user->name;
						if ($module == 'Teams') {
							$names[$user->id] = $team->name;
						}
						elseif ($module == 'Roles') {
							$names[$user->id] = $role->name;
						}
						else $names [$user->id] = $user->name;
					} else {
						continue;
					}
				}
			} else {
				if (strlen($bean->email1) > 0) {
					$emails[$bean->email1] = $bean->name;
					$names [$bean->id] = $bean->name;
				} else {
					continue;
				}
			}
			$bean = null;
		}
	}
	
	public function getUsersInTeams($teamIds, $activeOnly=true)
	{
		if (is_string($teamIds)) {
			$teamIds = array($teamIds);
		}
	
		$users = array();
	
		foreach ($teamIds as $teamId) {
			$teamObj     = new Team();
			$teamObj->retrieve($teamId);
			$teamMembers = $teamObj->get_team_members();
	
			if (count($teamMembers> 0)) {
				foreach($teamMembers as $teamMember) {
					if ($activeOnly) {
						if ($teamMember->status == 'Active') {
							$users[] = $teamMember;
						}
					} else {
						$users[] = $teamMember;
					}
				}
			}
		}
	
		return $users;
	}
	
	public function getUsersInRoles($roleIds, $activeOnly=true)
	{
		if (is_string($roleIds)) {
			$roleIds = array($roleIds);
		}
	
		$users = array();
	
		$role_id_string = "('" . implode("','", $roleIds) . "')";
	
		$active = "";
		if ($activeOnly){
			$active = "and users.status='Active'";
		}
	
		$userSelect =<<<SQL
	
        select distinct users.id as 'id'
        from acl_roles_users
        inner join acl_roles on acl_roles_users.role_id = acl_roles.id and acl_roles.deleted = 0
        inner join users on users.id = acl_roles_users.user_id and users.deleted = 0
        where acl_roles_users.deleted = 0 and acl_roles.id in {$role_id_string} $active
	
SQL;
	
		$db = DBManagerFactory::getInstance();
		$result = $db->query($userSelect);
	
		while(($row = $db->fetchByAssoc($result)) !== false) {
			$users[] = BeanFactory::getBean('Users', $row['id']);
		}
	
		return $users;
	}
}
