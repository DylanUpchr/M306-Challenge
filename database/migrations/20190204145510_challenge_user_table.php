<?php


use Phinx\Migration\AbstractMigration;

class ChallengeUserTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('challenge_user');
        $table->addColumn('admin', 'boolean')
            ->addColumn('challenge_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->create();
    }
}
