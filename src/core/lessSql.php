<?php
namespace Core;
use LessQL\Database;
/**
* http://lessql.net/ 
*/
class LessSql
{
	private static $instance;
	protected $db_config = [];
	protected $pdo;
	protected $db;
	
	function __construct($db_config)
	{
		echo ("LessSql dans core <br>");
		$this->db_config = $db_config;
		$this->pdo = new \PDO("mysql:host={$this->db_config['db_host']};".
			"dbname={$this->db_config['db_name']}",
			$this->db_config['db_user'],
			$this->db_config['db_pass']
			);
		$this->db = new Database($this->pdo);
	}

    /**
     * Gets the value of pdo.
     *
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Sets the value of pdo.
     *
     * @param mixed $pdo the pdo
     *
     * @return self
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

    /**
     * Gets the value of db.
     *
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Sets the value of db.
     *
     * @param mixed $db the db
     *
     * @return self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }
}