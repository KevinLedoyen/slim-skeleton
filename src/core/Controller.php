<?php
namespace Core;
use Slim\Container;
/**
* 
*/
class Controller
{
	
	protected $container;

    // constructor receives container instance
    public function __construct(Container $container) {
       $this->container = $container;
    }

}