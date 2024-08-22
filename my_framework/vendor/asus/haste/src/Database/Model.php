<?php namespace Asus\Haste\Database;
use Asus\Haste\Database\Database;
use PDOStatement;

class Model extends Database{
    protected string $table;
    protected PDOStatement $stmt;
    protected int $fetchMode=\PDO::FETCH_OBJ;

    public function __construct() {
        parent::__construct();
        }
    
        public function create(array $data) :bool
        {
            $key=array_keys($data);//['title','body'] => "title,body"
            $fields=implode(",",$key);//"title,body"
            $values=implode(",",array_map(fn($fields)=>":$fields",$key));//":title,:body"
            $this->stmt=$this->pdo->prepare("INSERT INTO $this->table($fields) VALUES ($values)");

            $this->bindValues($data);
            return $this->stmt->execute();
        }
        public function edit(array $data,int $id) :bool
        {
            $keys=array_keys($data);
            $fieldOfUpdate=implode(",",array_map(fn($field)=>"$field=:$field",$keys));//"title=:title,body:body"  
            $this->stmt=$this->pdo->prepare("UPDATE $this->table SET $fieldOfUpdate where id=:id");
            $this->bindValues(array_merge($data,['id'=>$id]));
            return $this->stmt->execute();

        }
        public function delete(int $id) :bool
        {
            $this->stmt=$this->pdo->prepare("DELETE FROM $this->table where id=:id");
            $this->bindValues(['id'=>$id]);
            return $this->stmt->execute();
        }
        public function get() :array|bool
        {
           
            return $this->select()->fetch();
        }
        public function getFirst() 
        {
            
            return $this->select()->fetch('fetch');
        }
        public function fetch($fetchMethode='fetchAll'){
            return $this->stmt->$fetchMethode($this->fetchMode);
        }
        public function select():self
        {
            $this->stmt=$this->pdo->prepare("SELECT * FROM $this->table");
            $this->stmt->execute();
            return $this;
        }


        protected function bindValues(?array $data=null): void
        {
            foreach($data as $key=>$value) {
            $this->stmt->bindValue($key,$value);
            }
        }
}

?>