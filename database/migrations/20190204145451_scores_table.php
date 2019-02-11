<?php


use Phinx\Migration\AbstractMigration;

class ScoresTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('scores');
        $table->addColumn('score', 'integer')
            ->addColumn('challenge_id', 'integer')
            ->addColumn('game_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->create();
    }
}
