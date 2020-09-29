<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users_name extends CI_Migration {

	public function up()
	{
		$fields = array(
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
            ),
		);
		$this->dbforge->add_column('users', $fields);
		///
		$fields = array(
			'login' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
		);
		$this->dbforge->modify_column('users', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'name');
		///
		$fields = array(
			'login' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
		);
		$this->dbforge->modify_column('users', $fields);
    }
}