<?php
 // created: 2013-01-28 14:40:28
$layout_defs["sched_SchedulerAlerts"]["subpanel_setup"]['sched_scheduleralerts_users'] = array (
  'order' => 100,
  'module' => 'Users',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCHED_SCHEDULERALERTS_USERS_FROM_USERS_TITLE',
  'get_subpanel_data' => 'sched_scheduleralerts_users',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
