<?php defined('SYSPATH') or die('No direct script access.');

/**
 * ORM ACL driver
 */
class ACL_Driver_ORM extends ACL {
	/**
	 * @see parent::check_access
	 */
	public function check_access(array $access = array())
	{
		if (empty($access))
		{
			return TRUE;
		}
		$roles = $this->get_auth_user_roles();
		foreach ($access as $a)
		{
			if ( ! in_array($a, $roles))
			{
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * @see parent::get_auth_user_roles()
	 */
	protected function get_auth_user_roles()
	{
		$user = $this->get_auth_user();
		$roles = array();
		if ($user)
		{
			foreach ($user->roles->find_all() AS $role)
			{
				$roles[] = $role->name;
			}
		}
		return $roles;
	}
}
