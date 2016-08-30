<?php
use Phalcon\Mvc\Controller;

class IndexController extends Controller {
	public function indexAction() {
		echo "<h1>hello, world</h1>";
// 		$this->response->appendContent("hello, world");
	}
}