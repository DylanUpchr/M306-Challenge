<?php


use Phinx\Migration\AbstractMigration;

class ChallengeGame extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('challenge_game');
        $table->addColumn('challenge_id', 'integer')
            ->addColumn('game_id', 'integer')
            ->create();
    }
}
