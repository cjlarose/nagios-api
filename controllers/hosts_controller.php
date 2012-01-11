<?php
class HostsController extends Controller {

	function index() {
		$hosts = Host::find('all');
		switch($this->data->getMethod()) {
			case 'get':
				$result_string = "[";
				$host_json_array = array();
				foreach ($hosts as $host)
					$host_json_array[] = $host->to_json();
				$result_string .= implode(',', $host_json_array);
				$result_string .= "]";
				$this->send_response(200, $result_string, 'application/json');
				break;
		}

	}

}
