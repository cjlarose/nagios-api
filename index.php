<?php

define('BASE_DIR', dirname(__FILE__) . '/');

require_once BASE_DIR . 'php-activerecord/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg) {

	$cfg->set_model_directory('models');
	$cfg->set_connections(array(
		'development' => 'mysql://nagiosapi:nagiosapi@localhost/ndoutils',
		'production' => 'mysql://nagios:nagios@localhost/nagios'
	));

});

$hosts = Host::find('all');

//echo "<pre>";
//var_dump($hosts);
//echo "</pre>";

//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
require_once 'RestUtils.php';
require_once 'RestRequest.php';
$data = RestUtils::processRequest();

switch($data->getMethod()) {
	case 'get':
		$result_string = "[";
		$host_json_array = array();
		foreach ($hosts as $host)
			$host_json_array[] = $host->to_json();
		$result_string .= implode(',', $host_json_array);
		$result_string .= "]";
		RestUtils::sendResponse(200, $result_string, 'application/json');
		break;
}
