<?php
$module_name = 'sched_SchedulerAlerts';
$listViewDefs[$module_name] = 
array (
  'name' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'assigned_user_name' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'user_name' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_USER_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'role_name' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ROLE_NAME',
    'width' => '10%',
    'default' => true,
  ),
);
