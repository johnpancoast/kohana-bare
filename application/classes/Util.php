<?php defined('SYSPATH') or die('No direct script access.');

/**
 * static utility functions
 */
class Util {
	/**
	 * print a backtrace using kohana's error tpl
	 * @access public
	 * @static
	 * @param array $backtrace A php backtrace. If not provided, it will be generated internally.
	 * @return Kohana_View
	 */
	public static function trace(array $debug_trace = array())
	{
		$bt = ( ! empty($debug_trace)) ? $debug_trace : Debug::trace();
		$index = 0;

		$class   = NULL;
		$code    = 0;
		$message = 'Backtrace';
		$file    = $bt[$index]['file'];
		$line    = $bt[$index]['line'];
		$trace   = $bt;
		$view = View::factory('kohana/error', get_defined_vars());
		return $view;
	}
}
