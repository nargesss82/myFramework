<?php

use Asus\Core\Application;

return new class{


    public function up():void
    {
        $sql="ALTER TABLE users ADD COLUMN password varchar(255) not null";
       $db=new Application(__DIR__);
       $db->db->pdo->exec($sql);
    }

    public function down():void
    {
        $sql="ALTER TABLE users drop column password";
        $db=new Application(__DIR__);
       $db->db->pdo->exec($sql);
    }



};



?>