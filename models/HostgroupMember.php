<?php
class HostgroupMember extends ActiveRecord\Model {

	static $table_name = 'nagios_hostgroup_members';

	static $primary_key = 'hostgroup_member_id';

	static $belongs_to = array(array('host', 'primary_key' => 'host_object_id'));
}
