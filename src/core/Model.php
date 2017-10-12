<?php
namespace Core;
use Core\Database;
use \PDO;

/**
* 
*/
class Model extends Database 
{
	public $db_config = [
		'db_host' => 'localhost',
		'db_name' => 'foo',
		'db_user' => 'dev',
		'db_pass' => '123456'
	];

    private $stmt;
    private $data;
    private $sql;
    private $where;
    private $fields;
    public  $count;

    public function __construct()
    {
        parent::__construct();
        self::setTable();
        self::setPrimaryKey();
    }

    private function setTable()
    {
        if ( ! isset($this->table)) {
            $modelName = (new \ReflectionClass($this))->getShortName();
            $this->table = strtolower($modelName);            
        }
    }

    private function setPrimaryKey()
    {
        if ( ! isset($this->pk)) {
            $this->pk = 'id';
        }
    }

    private function param($data = null)
    {
        if (empty($data)) {
            $data = $this->dados['conditions'];
        }

        foreach ($data as $k => $v) {
            $tipo = (is_int($v)) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $this->stmt->bindValue(":{$k}", $v, $tipo);
        }
    }

    private function fields($data = null)
    {
        if (empty($data) && array_key_exists('fields', $this->dados)) {
            return implode(',', $this->dados['fields']);
        }

        if ( ! empty($data)) {
            foreach ($data as $k => $v) {
                $fields[] = $k;
            }
            return implode(',', $fields);
        }

        return '*';
    }

    private function conditions($separator)
    {
        $param = [];
        foreach ($this->dados['conditions'] as $k => $v) {
            $param[] = "{$k} = :{$k}";
        }

        return implode($separator, $param);
    }

    private function where()
    {
        return $this->where = (array_key_exists('conditions', $this->dados))
                              ? 'WHERE ' . self::conditions(' AND ')
                              : '';
    }

    private function find()
    {
        $sql = "SELECT ".self::fields()." FROM {$this->table} ".self::where();

        $this->stmt = $this->conn->prepare($sql);

        if ( ! empty($this->where)) {
            self::param();
        }

        $this->stmt->execute();
        return $this;
    }

    private function values()
    {
        foreach ($this->dados as $k => $v) {
            $values[] = ":{$k}";
        }

        return implode(',', $values);
    }

    private function insertQueryString()
    {
        $fields = self::fields($this->dados);
        $values = self::values();

        return "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
    }

    private function updateWhere($data)
    {
        $this->dados['conditions'] = [$this->pk => $data[$this->pk]];
        $where = 'WHERE '.self::conditions('');
        unset($data[$this->pk]);

        return $where;
    }

    private function updateQueryString($data)
    {
        $this->dados['conditions'] = $data;
        $fields = self::conditions(',');

        return "UPDATE {$this->table} SET {$fields} {$this->where}";
    }

    public function findAll($data = null)
    {
        $this->dados = $data;
        return $this->find()
                    ->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($data)
    {
        $this->dados['conditions'] = $data;
        return $this->find()
                    ->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        return self::findOne([$this->pk => $id]);
    }

    public function query($sql)
    {
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute();
        $result      = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->count = count($result);

        return $result;
    }

    public function save($data)
    {
        if (array_key_exists($this->pk, $data)) {
            $this->count = $this->findOne([$this->pk => $data[$this->pk]]);
        }

        if (! empty($this->count)) {
            return $this->update($data);
        }

        return $this->create($data);
    }

    public function update($data)
    {
        if ( ! array_key_exists($this->pk, $data)) {
            return false;
        }

        $param       = $data;
        $this->where = self::updateWhere($data);
        $this->stmt  = $this->conn->prepare(self::updateQueryString($data));
        self::param($param);
        $this->stmt->execute();
        $this->count = $this->stmt->rowCount();
    }

    public function create($data)
    {
        $this->dados = $data;

        $this->stmt = $this->conn->prepare(self::insertQueryString());
        self::param($data);

        $this->stmt->execute();
        $this->count = $this->stmt->rowCount();
    }

}
