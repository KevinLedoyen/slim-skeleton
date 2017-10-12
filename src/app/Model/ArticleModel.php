<?php
namespace App\Model;
use Core\Model;

/**
* 
*/
class ArticleModel extends Model
{
	public $table = 'test';
	public $pk    = 'id_test';

	public function getAll()
	{
		$req = 'SELECT * FROM $this->table';
		var_dump($req);
		return $this->query($req);
	}
}