<?php
namespace App;
use Core;

/**
* 
*/
class App
{



	/**
     * 
     * une variable
     *
     * @var string
     */
    private $variable;

	public function __construct()
	{
		
	}


    /**
     * Gets the une variable.
     *
     * @return string
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * Sets the une variable.
     *
     * @param string $variable the variable
     *
     * @return self
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }
}

