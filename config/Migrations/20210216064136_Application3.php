<?php
use Migrations\AbstractMigration;

class Application3 extends AbstractMigration
{

    public function up()
    {

        $this->table('applications')
            ->addColumn('gender', 'string', [
                'after' => 'phone',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('applications')
            ->removeColumn('gender')
            ->update();
    }
}

