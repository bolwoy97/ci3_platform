<?php


trait GridTools {
   
	public function prepare_grid_users($users, $fields)
	{
		$new_array = array();
		foreach ($users as $k1 =>$user) {
			$new_array[$k1] = $this->prepare_grid_user($user, $fields);
		}
		return $new_array;
	}

	public function prepare_grid_user($user, $fields)
	{
		$new_user = array();
		foreach ($fields as $k => $field) {
			if(isset($user[$field]))
			$new_user[$field] = $user[$field];
		}
		$new_user['is_active'] = ($user['chPasHash']!='unprn');
		$new_user['is_grid'] = 1;
		return $new_user;
	}
}