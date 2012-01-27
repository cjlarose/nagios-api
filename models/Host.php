<?php
class Host extends ActiveRecord\Model {

	static $table_name = 'nagios_hosts';

	static $primary_key = 'host_object_id';

	static $has_one = array(array('hoststatus', 'foreign_key' => 'host_object_id'));
	static $has_many = array(
		array('services', 'foreign_key' => 'host_object_id'),
		array('hostgroupmembers', 'foreign_key' => 'host_object_id')
	);
}
