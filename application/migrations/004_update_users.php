<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_users extends CI_Migration {

	public function up()
	{
		$fields = array(
			'sponsor' => array(
				'type' => 'INT',
				'after' => 'password',
			),
			'hash' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
		);
		$this->dbforge->add_column('users', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'sponsor');
		$this->dbforge->drop_column('users', 'hash');
    }
}