<?php
// created: 2013-02-19 15:06:04
$dictionary["User"]["fields"]["sched_scheduleralerts_users"] = array (
  'name' => 'sched_scheduleralerts_users',
  'type' => 'link',
  'relationship' => 'sched_scheduleralerts_users',
  'source' => 'non-db',
  'vname' => 'LBL_SCHED_SCHEDULERALERTS_USERS_FROM_SCHED_SCHEDULERALERTS_TITLE',
  'id_name' => 'sched_scheduleralerts_userssched_scheduleralerts_ida',
);
$dictionary["User"]["fields"]["sched_scheduleralerts_users_name"] = array (
  'name' => 'sched_scheduleralerts_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCHED_SCHEDULERALERTS_USERS_FROM_SCHED_SCHEDULERALERTS_TITLE',
  'save' => true,
  'id_name' => 'sched_scheduleralerts_userssched_scheduleralerts_ida',
  'link' => 'sched_scheduleralerts_users',
  'table' => 'sched_scheduleralerts',
  'module' => 'sched_SchedulerAlerts',
  'rname' => 'name',
);
$dictionary["User"]["fields"]["sched_scheduleralerts_userssched_scheduleralerts_ida"] = array (
  'name' => 'sched_scheduleralerts_userssched_scheduleralerts_ida',
  'type' => 'link',
  'relationship' => 'sched_scheduleralerts_users',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCHED_SCHEDULERALERTS_USERS_FROM_USERS_TITLE',
);
