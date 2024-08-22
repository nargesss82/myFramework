<?php

use Asus\Haste\Application;

return new class{


    public function up():void
    {
        $sql="CREATE TABLE articles(
        id int auto_increment primary key,
        title varchar(255) not null,
        body text not null,
        created_at timestamp default current_timestamp
        )";
       $db=new Application(__DIR__);
       $db->db->pdo->exec($sql);
    }

    public function down():void
    {
        $sql="DROP TABLE articles";
        $db=new Application(__DIR__);
       $db->db->pdo->exec($sql);
    }



};



?>