<?php
namespace App;
use Core\lessSql;
/**
* AppModel est une classe qui permet d'instancier la class LessSql (dans core)
* Tous les model de l'application seront enfant de cette classe et hériterons de ces méthodes
* Elle permet de regrouper les comportements spécifiques à l'application
*/
class AppModel extends lessSql
{
	protected $db_config = [
		'db_host' => 'localhost',
		'db_name' => 'foo',
		'db_user' => 'dev',
		'db_pass' => '123456'
	];
	protected $table;

	public function __construct()
	{
		parent::__construct($this->db_config);
	}

	/*
	exemple d'array
		array(
		    'title' => 'Fantasy Movie Review',
		    'author' => array(
		        'name' => 'Fantasy Guy'
		    ),
		    'categorizationList' => array(

		        array(
		            'category' => array( 'title' => 'Movies' )
		        ),
		        array(
		            'category' => $existingFantasyCategory
		        )
		    )
		) 
	*/
	function row(array $entity)
	{
		$row = $this->db->createRow($this->table, $entity);
	}
}