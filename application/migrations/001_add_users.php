<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

	public function up()
	{
        $this->dbforge->add_field('id');
		$this->dbforge->add_field(array(
			'login' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
            'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
            ),
			'balance' => array(
				'type' => 'DOUBLE',
			),
		));
		//$this->dbforge->add_key('id');
		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
    }
}