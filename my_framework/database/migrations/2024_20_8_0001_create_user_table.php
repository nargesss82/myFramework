<?php

use Asus\Core\Application;

return new class{


    public function up():void
    {
        $sql="CREATE TABLE users(
        id int auto_increment primary key,
        name varchar(255) not null,
        email varchar(255) not null,
        created_at timestamp default current_timestamp
        )";
       $db=new Application(__DIR__);
       $db->db->pdo->exec($sql);
    }

    public function down():void
    {
        $sql="DROP TABLE users";
        $db=new Application(__DIR__);
       $db->db->pdo->exec($sql);
    }



};



?>