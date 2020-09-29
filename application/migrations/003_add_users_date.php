<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users_date extends CI_Migration {

	public function up()
	{
		$fields = array(
			'date' => array(
				'after' => 'id',
				'type' => 'DATETIME',
			),
			'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
		);
		$this->dbforge->add_column('users', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('users', 'date');
		$this->dbforge->drop_column('users', 'created_date');
		$this->dbforge->drop_column('users', 'updated_date');
    }
}