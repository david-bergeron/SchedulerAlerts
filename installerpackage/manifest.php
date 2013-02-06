<?php
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


// THIS CONTENT IS GENERATED BY MBPackage.php
$manifest = array (
  0 => 
  array (
    'acceptable_sugar_versions' => 
    array (
      0 => '',
    ),
  ),
  1 => 
  array (
    'acceptable_sugar_flavors' => 
    array (
      0 => 'PRO',
    ),
  ),
  'readme' => '',
  'key' => 'sched',
  'author' => 'dbergeron',
  'description' => '',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'SchedulerAlerts',
  'published_date' => '2013-01-28 21:40:27',
  'type' => 'module',
  'version' => '1.0',
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'SchedulerAlerts',
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'sched_SchedulerAlerts',
      'class' => 'sched_SchedulerAlerts',
      'path' => 'modules/sched_SchedulerAlerts/sched_SchedulerAlerts.php',
      'tab' => true,
    ),
  ),
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/sched_scheduleralerts_users_sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
    ),
  ),
  'relationships' => 
  array (
    0 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/sched_scheduleralerts_usersMetaData.php',
    ),
  ),
  'image_dir' => '<basepath>/icons',
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/modules/sched_SchedulerAlerts',
      'to' => 'modules/sched_SchedulerAlerts',
    ),
    1 => array(
      'from' => '<basepath>/Files/custom/Extension/modules/Administration/Ext/Administration/sched_options.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Administration/sched_options.php',
    ),
    2 => array(
      'from' => '<basepath>/Files/custom/modules/SchedulersJobs/SchedulersJobs_Failure.php',
      'to' => 'custom/modules/SchedulersJobs/SchedulersJobs_Failure.php',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_us',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'bg_BG',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'cs_CZ',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'da_DK',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'de_DE',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'el_EL',
    ),
    6 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'es_ES',
    ),
    7 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'fr_FR',
    ),
    8 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'he_IL',
    ),
    9 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'hu_HU',
    ),
    10 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'it_it',
    ),
    11 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lt_LT',
    ),
    12 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ja_JP',
    ),
    13 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ko_KR',
    ),
    14 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lv_LV',
    ),
    15 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nb_NO',
    ),
    16 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nl_NL',
    ),
    17 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pl_PL',
    ),
    18 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_PT',
    ),
    19 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ro_RO',
    ),
    20 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ru_RU',
    ),
    21 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sv_SE',
    ),
    22 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'tr_TR',
    ),
    23 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'zh_CN',
    ),
    24 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_BR',
    ),
    25 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ca_ES',
    ),
    26 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_UK',
    ),
    27 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sr_RS',
    ),
    28 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sk_SK',
    ),
    29 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sq_AL',
    ),
    30 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'en_us',
    ),
    31 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'bg_BG',
    ),
    32 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'cs_CZ',
    ),
    33 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'da_DK',
    ),
    34 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'de_DE',
    ),
    35 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'el_EL',
    ),
    36 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'es_ES',
    ),
    37 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'fr_FR',
    ),
    38 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'he_IL',
    ),
    39 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'hu_HU',
    ),
    40 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'it_it',
    ),
    41 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'lt_LT',
    ),
    42 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'ja_JP',
    ),
    43 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'ko_KR',
    ),
    44 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'lv_LV',
    ),
    45 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'nb_NO',
    ),
    46 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'nl_NL',
    ),
    47 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'pl_PL',
    ),
    48 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'pt_PT',
    ),
    49 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'ro_RO',
    ),
    50 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'ru_RU',
    ),
    51 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'sv_SE',
    ),
    52 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'tr_TR',
    ),
    53 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'zh_CN',
    ),
    54 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'pt_BR',
    ),
    55 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'ca_ES',
    ),
    56 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'en_UK',
    ),
    57 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'sr_RS',
    ),
    58 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'sk_SK',
    ),
    59 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
      'language' => 'sq_AL',
    ),
    60 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
  ),
  'vardefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/sched_scheduleralerts_users_Users.php',
      'to_module' => 'Users',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/sched_scheduleralerts_users_sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
    ),
  ),
  'layoutfields' => 
  array (
    0 => 
    array (
      'additional_fields' => 
      array (
        'Users' => 'sched_scheduleralerts_users_name',
      ),
    ),
  ),
  'wireless_subpanels' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/sched_scheduleralerts_users_sched_SchedulerAlerts.php',
      'to_module' => 'sched_SchedulerAlerts',
    ),
  ),
  'logic_hooks' =>
  array(
  	'module' => 'sched_SchedulerAlerts',
  	'hook' => '',
  	'order' => 99,
  	'description' => 'job failure',
  	'file' => 'modules/sched_SchedulerAlerts/Hooks/SchedulersJobs_Failure.php',
  	'class' => 'SchedulersJobs_Failure',
  	'function' => 'Failure',
  ),
);