<?php
use Migrations\AbstractMigration;

class ApplicationDob extends AbstractMigration
{

    public function up()
    {

        $this->table('applications')
            ->addColumn('dob', 'date', [
                'after' => 'gender',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('applications')
            ->removeColumn('dob')
            ->update();
    }
}

