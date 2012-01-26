<?php
class HostsController extends Controller {

	function index() {
		$hosts = Host::find('all', array('joins' => array('hoststatus')));
		$result_string = "[";
		$host_json_array = array();
		foreach ($hosts as $host)
			$host_json_array[] = $host->to_json(array('include' => array('hoststatus')));
		$result_string .= implode(',', $host_json_array);
		$result_string .= "]";
		$this->send_response(200, $result_string, 'application/json');
	}

	function get($id) {
		if (empty($id))
			exit();

		$host = Host::find($id, array('joins' => array('hoststatus')));
		$this->send_response(200, $host->to_json(array('include' => array('hoststatus'))), 'application/json');	
	}
}
