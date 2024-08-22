<?php namespace  Asus\Haste\Database;

use Asus\Haste\Application;
use Asus\Haste\Database\Database;
use PDO;

class Migrations{
    public function __construct(public Database $db) {
      
    }
    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigrations=$this->getappliedMigrations();
        $appliedMigrations=array_map(fn($migration)=>$migration->migration,$appliedMigrations);
        $files=scandir(Application::$ROOT_DIR.'/database/migrations');

        $migrations=array_diff($files,$appliedMigrations);
        

        foreach($migrations as $migration){
            if($migration==='.'||$migration==='..'){
                continue;
            }
            $migrationInstance=require_once Application::$ROOT_DIR."/database/migrations/$migration";
        
        
        $this->log("applying migration $migration");
       $migrationInstance->up();
        $this->log("applied migration $migration");

        $newMigrations[]=$migration;
        }
        if(!empty($newMigrations)){

            $this->saveMigrations($newMigrations);
        }
        else{
            $this->log("There are no migrations to apply");
        }
    }
    public function rollbackMigrations()
    {
        // $this->log("rollback...");
        $appliedMigrations=$this->getappliedMigrations();
        $lastBatch=$this->lastBatchNumber();
        // var_dump($appliedMigrations);die;
        $mustRollbackMigrations=array_filter($appliedMigrations,fn($migration) => $migration->batch == $lastBatch);
        foreach ($mustRollbackMigrations as $migration) {
            $migrationInstance=require_once Application::$ROOT_DIR."/database/migrations/{$migration->migration}";
            $this->log("rolling back migration {$migration->migration}");
        $migrationInstance->down();
        $this->log("rolled back migration {$migration->migration}");
        }
        if(!empty($mustRollbackMigrations)){

            $this->deleteMigrations(array_map(fn($migration)=> $migration->id,$mustRollbackMigrations));
        }
        else{
            $this->log("There are no migrations to rollback");
        }
    }

    public function createMigrationTable()
    {
        $this->db->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
        id int auto_increment primary key,
        migration varchar(255),
        batch int,
        created_at timestamp default current_timestamp
        )ENGINE=INNODB");
    }
    protected function saveMigrations($newMigrations)
    {
        $batchNumber=$this->lastBatchNumber()+1;
        $rows=implode(array_map(fn($migration)=>"('$migration',$batchNumber)",$newMigrations));
        $this->db->pdo->exec("INSERT INTO migrations(migration,batch)values $rows");
    }
    protected function deleteMigrations($migrationIds)
    {
        
        $id=$migrationIds[1];
        
        $this->db->pdo->exec("DELETE FROM migrations where id=$id");
        
        
    }
    private function lastBatchNumber():int
    {
        $stmt=$this->db->pdo->prepare("SELECT MAX(batch) FROM migrations");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN)??0;
    }

    protected function getappliedMigrations(): ?array
    {
        $stmt=$this->db->pdo->prepare("SELECT id,migration,batch FROM migrations");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    private function log($massage)
    {
        $time=date("Y-m-d H-i-s");
        echo "[$time]  $massage ". PHP_EOL;
    }
}

?>