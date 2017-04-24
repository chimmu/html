<?php

use Phalcon\Mvc\Controller;
class BaseController extends Controller {
	protected $resp;
	protected $data;
	function initialize() {
		if (!$this->request->isPost()) {
			$this->resp["status"] = -2;
			$this->resp["message"] = "must be post" ;
			$this->response->setContent(json_encode($this->resp))->send();
			exit;
		}
		try {
			$this->data = json_decode($this->request->getRawBody(), true);
		} catch (Exception $e) {
			$this->resp['status'] = -10101;
			$this->resp['message'] = 'invalid paramters';
			$this->response->setContent(json_encode($this->resp))->send();
			exit;
		}
	}

	public function afterExecuteRoute($dispatcher)
	{
		$respstr = json_encode($this->resp);
		$this->logger->log("from:".$_SERVER['REMOTE_ADDR']." uri:".$_SERVER['REQUEST_URI'].
			" method:".$_SERVER['REQUEST_METHOD']." body:".$this->request->getRawBody()." resp:$respstr");
		$this->response->setContent($respstr)->send();
		// Executed after every found action
	}
}
