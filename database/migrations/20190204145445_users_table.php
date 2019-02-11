<?php


use Phinx\Migration\AbstractMigration;

class UsersTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string')
            ->addColumn('pasword', 'string')
            ->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('access_token', 'string')
            ->create();
    }
}
