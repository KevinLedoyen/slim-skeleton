<?php
namespace App;
use Core\Controller;
use Slim\Container;

/**
* 
*/
class AppController Extends Controller
{	
	protected $settings = [];

	public function __construct($container){
		parent::__construct($container);
		global $settings;
		$this->settings = $settings;
	}

	protected function page_404($request, $response, $args){
		$notFoundHandler = $this->container->get('notFoundHandler');
		return $notFoundHandler($request, $response, $args);
	}

	protected function render($response, $file, $args){
		$renderer = $this->container->get('renderer');
		return $renderer->render($response, $file, $args);
	}
}