<?php


use Phinx\Migration\AbstractMigration;

class AuthorsTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('authors');
        $table->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('game_id', 'integer')
            ->create();
    }
}
