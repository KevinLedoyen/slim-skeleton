<?php
namespace App\Controller;
use App\AppController;
// use Slim\Container;

/**
* 
*/
class StaticPageController Extends AppController
{	
	private $default_page = "index.php";


	public function __construct($container){
		parent::__construct($container);
		global $settings;
		$this->settings = $settings;
	}

	public function home($request, $response, $args){
		return $this->render($response, 'index.php', $args);
	}

	public function staticPage($request, $response, $args)
	{    
		$this->page = (isset($args['page'])) ? $args['page'].'.php' : $this->default_page;
		$renderer = $this->container->get('renderer');
		return $this->page_404($request, $response, $args);
		// var_dump($this->page);
		return $this->render($response, 'static/'.$this->page, $args);
	}


}