<?php


use Asus\Haste\Application;

return new class {


    public function up(): void
    {
        $sql = "ALTER TABLE `users` ADD UNIQUE(`email`)";
        $db = new Application(__DIR__);
        $db->db->pdo->exec($sql);
    }

    public function down(): void
    {
        $sql = "ALTER TABLE `users` DROP INDEX `email`";
        $db = new Application(__DIR__);
        $db->db->pdo->exec($sql);
    }


};




