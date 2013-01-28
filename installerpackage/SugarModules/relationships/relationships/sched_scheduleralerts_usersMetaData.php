<?php
// created: 2013-01-28 14:40:28
$dictionary["sched_scheduleralerts_users"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'sched_scheduleralerts_users' => 
    array (
      'lhs_module' => 'sched_SchedulerAlerts',
      'lhs_table' => 'sched_scheduleralerts',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'sched_scheduleralerts_users_c',
      'join_key_lhs' => 'sched_scheduleralerts_userssched_scheduleralerts_ida',
      'join_key_rhs' => 'sched_scheduleralerts_usersusers_idb',
    ),
  ),
  'table' => 'sched_scheduleralerts_users_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'sched_scheduleralerts_userssched_scheduleralerts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'sched_scheduleralerts_usersusers_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'sched_scheduleralerts_usersspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'sched_scheduleralerts_users_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'sched_scheduleralerts_userssched_scheduleralerts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'sched_scheduleralerts_users_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'sched_scheduleralerts_usersusers_idb',
      ),
    ),
  ),
);