<?php
use Migrations\AbstractMigration;

class ApplicationTable extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('applications')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('phone', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {

        $this->table('applications')->drop()->save();
    }
}

