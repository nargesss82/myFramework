<?php namespace Asus\Haste\Database;
use Asus\Haste\Database\Database;
use PDOStatement;

class Model extends Database{
    protected string $table;
    protected PDOStatement $stmt;

    public function __construct() {
        parent::__construct();
        }
    
        public function create(array $data) 
        {
            $key=array_keys($data);//['title','body'] => "title,body"
            $fields=implode(",",$key);//"title,body"
            $values=implode(",",array_map(fn($fields)=>":$fields",$key));//":title,:body"
            $this->stmt=$this->pdo->prepare("INSERT INTO $this->table($fields) VALUES ($values)");

            $this->bindValues($data);
            return $this->stmt->execute();
        }


        protected function bindValues(?array $data=null): void
        {
            foreach($data as $key=>$value) {
            $this->stmt->bindValue($key,$value);
            }
        }
}

?>