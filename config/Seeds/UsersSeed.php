<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'root',
                'email' => 'root@tcic.com',
                'mobile' => '9820592630',
                'password' => '$2y$10$YzWKCsKp7Fim/rYaZsKkV.Vdb8b6DKq8NFlrYgkgsT8HAbjgwcYzy',
                'activation_key' => NULL,
                'api_key_plain' => NULL,
                'api_key' => NULL,
                'active' => '1',
                'created' => '2018-08-21 09:48:02',
                'modified' => '2020-07-20 20:21:37',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
