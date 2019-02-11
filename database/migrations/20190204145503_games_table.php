<?php


use Phinx\Migration\AbstractMigration;

class GamesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('games');
        $table->addColumn('name', 'string')
            ->create();
    }
}
