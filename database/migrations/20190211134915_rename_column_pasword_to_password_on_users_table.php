<?php


use Phinx\Migration\AbstractMigration;

class RenameColumnPaswordToPasswordOnUsersTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->renameColumn('pasword', 'password');
        $table->save();
    }
}
