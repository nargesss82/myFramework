<?php namespace Asus\Haste\Database;
use Asus\Haste\Database\Database;
use PDOStatement;

class Model extends Database{
    protected string $table;
    protected PDOStatement $stmt;
    protected int $fetchMode=\PDO::FETCH_OBJ;
    protected array $selectedFields=[];
    protected int $limit=0;
    protected array $whereList=[];
    protected array $valuesForBind=[];


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
            $query[]="SELECT";
            if(count($this->selectedFields)>0){
                $query[]=implode(",",$this->selectedFields);
            }else{
                $query[]="*";
            }
            $query[]=" FROM $this->table";
            if(count($this->whereList)){
                $query[]=$this->prepareWhere();
            }
            if($this->limit>0){
                $query[]="LIMIT $this->limit";
            }
            //var_dump($query);die;
            $this->stmt=$this->pdo->prepare(implode(" ",$query));
            $this->bindValues();
            $this->stmt->execute();
            return $this;
        }
        public function where(string $name,$value,string $operator="="):self
        {
            $this->whereList[]="$name $operator :$name";
            $this->valuesForBind[$name]=$value;
            return $this;
        }
        public function prepareWhere():string
        {
            //
            $query[]="where";
            foreach ($this->whereList as $key => $value) {
                if($key !== array_key_first($this->whereList)){
                    $query[]="AND";
                }
                $query[]=$value;
            }
            //var_dump(implode(" ",$query));die;
            return implode(" ",$query);
        }
        public function find($value,$field='id')
        {
            return $this->where($field,$value)->getFirst();
        }
        public function getFieldsForSelect():self
        {
            
            $this->selectedFields=func_get_args();
            return $this;
        }
        public function limit(int $limit):self
        {
            $this->limit=$limit;
            return $this;
        }


        protected function bindValues(?array $data=null): void
        {
            if($data){
                $this->valuesForBind=array_merge($this->valuesForBind,$data);

            }
            foreach($this->valuesForBind as $key=>$value) {
            $this->stmt->bindValue($key,$value);
            }
        }
}

?>