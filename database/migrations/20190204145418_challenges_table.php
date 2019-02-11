<?php


use Phinx\Migration\AbstractMigration;

class ChallengesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('challenges');
        $table->addColumn('name', 'string')
            ->addColumn('start_date', 'datetime')
            ->addColumn('end_date', 'datetime')
            ->create();
    }
}
