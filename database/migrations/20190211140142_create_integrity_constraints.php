<?php


use Phinx\Migration\AbstractMigration;

class CreateIntegrityConstraints extends AbstractMigration
{
    public function change()
    {
        // Scores constraints.
        $table = $this->table('scores');
        $table->addForeignKey('challenge_id', 'challenges', ['id'])
            ->addForeignKey('game_id', 'games', ['id'])
            ->addForeignKey('user_id', 'users', ['id'])
            ->save();

        // Games constraints.
        $table = $this->table('authors');
        $table->addForeignKey('game_id', 'games', ['id'])
            ->save();

        // Challenge User constraints.
        $table = $this->table('challenge_user');
        $table->addForeignKey('challenge_id', 'challenges', ['id'])
            ->addForeignKey('user_id', 'users', ['id'])
            ->save();

        // Challenge Game constraints.
        $table = $this->table('challenge_game');
        $table->addForeignKey('challenge_id', 'challenges', ['id'])
            ->addForeignKey('game_id', 'games', ['id'])
            ->save();
    }
}
