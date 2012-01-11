<?php

class Controller {

	private $request = array('controller' => NULL, 'action' => NULL, 'params' => array());
	protected $data;

	public function __construct() {
		ActiveRecord\Config::initialize(function($cfg) {

			$cfg->set_model_directory('models');
			$cfg->set_connections(array(
				'development' => 'mysql://nagiosapi:nagiosapi@localhost/ndoutils',
				'production' => 'mysql://nagiosapi:nagiosapi@localhost/nagios'
			));
			
			$cfg->set_default_connection('production');
		});

		$this->process_request();
	}

	public function set_request($request = array()) {
		$this->request = $request;
	}

	private function process_request() {
		$this->data = RestUtils::processRequest();
	}

	protected function send_response($status = 200, $body = '', $content_type = 'text/html') {
		RestUtils::sendResponse($status, $body, $content_type);
	}

	//protected function set($view_vars = array()) {
	//	foreach ($view_vars as $key => $value) 
	//		$this->view_vars[$key] = $value;
	//}
	
	//public function render() {
	//	extract($this->view_vars);
	//	//echo "hello";
	//	//include BASE_PATH . 'views/' . $this->request['action'] . '.php';
	//	if ($this->request['controller'] == 'pages') 
	//		include BASE_PATH . 'views/' . $this->request['controller'] . '/' . $this->request['params'][0] . '.php';
	//	else 
	//		include BASE_PATH . 'views/' . $this->request['controller'] . '/' . $this->request['action'] . '.php';
	//}
	
}
