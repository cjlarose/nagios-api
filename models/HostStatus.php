<?php
class HostStatus extends ActiveRecord\Model {
	
	static $table_name = 'nagios_hoststatus';

	static $primary_key = 'hoststatus_id';
}
