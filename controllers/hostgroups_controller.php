<?php
class HostgroupsController extends Controller {

	function index() {
		$host_groups = Hostgroup::find('all');
		$result_string = "[";
		$host_json_array = array();
		foreach ($host_groups as $host_group)
			$host_json_array[] = $host_group->to_json(array('include' => array('hostgroupmembers', 'hosts')));//$host_group->to_json(array('include' => array('hostgroupmembers', 'hosts')));
		$result_string .= implode(',', $host_json_array);
		$result_string .= "]";
		$this->send_response(200, $result_string, 'application/json');
	}

	function get($id) {
		$host_group = Hostgroup::find($id);
		//$response = $host_group->to_json(array('include' => array('hostgroupmembers')));

		$hosts = Hostgroup::find_by_sql("SELECT `nagios_hosts`.* FROM `nagios_hosts` INNER JOIN `nagios_hostgroup_members` ON(`nagios_hosts`.host_object_id = `nagios_hostgroup_members`.host_object_id) WHERE `hostgroup_id`='{$id}'");
		$result_string = "[";
		$host_json_array = array();
		foreach ($hosts as $host)
			$host_json_array[] = $host->to_json();//$host_group->to_json(array('include' => array('hostgroupmembers', 'hosts')));
		$result_string .= implode(',', $host_json_array);
		$result_string .= "]";

		$this->send_response(200, $result_string, 'application/json');
	}

}
