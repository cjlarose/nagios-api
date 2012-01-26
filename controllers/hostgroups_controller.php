<?php
class HostgroupsController extends Controller {

	function index() {
		$host_groups = HostGroup::find('all');
		$result_string = "[";
		$host_json_array = array();
		foreach ($host_groups as $host_group)
			$host_json_array[] = $host_group->to_json(array('include' => array('hosts')));
		$result_string .= implode(',', $host_json_array);
		$result_string .= "]";
		$this->send_response(200, $result_string, 'application/json');
	}

}
