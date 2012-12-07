<?php defined('SYSPATH') or die('No direct script access.');

/**
 * very basic abstract ACL class
 * @abstract
 */
abstract class ACL {
	/**
	 * @var array instances of acl drivers
	 * @access private
	 * @static
	 */
	private static $instances = array();

	/**
	 * return a driver instance
	 * @access public
	 * @static
	 * @param string $driver A driver to load
	 * @return ACL A child class of this (a driver)
	 */
	public static function instance($driver = NULL)	
	{
		$cfg_driver = Kohana::$config->load('acl.driver');
		$default_driver = $cfg_driver ? $cfg_driver : 'ORM';
		$driver = $driver ? $driver : $default_driver;
		if (!isset(self::$instances[$driver]))
		{
			$class = 'ACL_Driver_'.ucfirst(preg_replace('/[^\w]/', '', $driver));
			self::$instances[$driver] = new $class;
		}
		return self::$instances[$driver];
	}

	/**
	 * get the authenticated user
	 * @access protected
	 * @return mixed An auth user (by default this will be {@see Model_User} but it could be something depending on what the Auth driver does)
	 */
	protected function get_auth_user()
	{
		return Auth::instance()->get_user();
	}

	/**
	 * get authenticated user roles
	 * @abstract
	 * @access protected
	 */
	abstract protected function get_auth_user_roles();

	/**
	 * check user access
	 * @abstract
	 * @access public
	 * @param array $access An array of the roles we're checking.
	 */
	abstract public function check_access(array $access = array());
}
