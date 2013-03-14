<?php
$module_name = 'sched_SchedulerAlerts';
$viewdefs[$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'DELETE',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'schedulers_id',
            'label' => 'LBL_SCHEDULERS_ID',
          ),
          1 => 
          array (
            'name' => 'user_names',
            'label' => 'LBL_USER_NAMES',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'team_names',
            'label' => 'LBL_TEAM_NAMES',
          ),
          1 => 
          array (
            'name' => 'role_names',
            'label' => 'LBL_ROLE_NAMES',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
