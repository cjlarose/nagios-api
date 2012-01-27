<?php
class HostgroupmembersController extends Controller {

	function index() {
		$host_groups = Hostgroupmember::find('all');
		//pr($host_groups);
		$result_string = "[";
		$host_json_array = array();
		foreach ($host_groups as $host_group)
			$host_json_array[] = $host_group->to_json(array('include' => array('hostgroup', 'host')));
		$result_string .= implode(',', $host_json_array);
		$result_string .= "]";
		$this->send_response(200, $result_string, 'application/json');
	}

}
