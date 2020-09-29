<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_users extends CI_Migration {

	public function up()
	{
		if (!$this->db->field_exists('role', 'users'))
		{
			$fields = array(
				'role' => array(
					'type' => 'INT',
					'after' => 'password',
				),
			);
			$this->dbforge->add_column('users', $fields);
		}

		if ($this->db->field_exists('created_date', 'users'))
		{
				$this->dbforge->drop_column('users', 'created_date');
		}
		if ($this->db->field_exists('updated_date', 'users'))
		{
				$this->dbforge->drop_column('users', 'updated_date');
		}
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'role');
		$fields = array(
			'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
		);
		$this->dbforge->add_column('users', $fields);
    }
}