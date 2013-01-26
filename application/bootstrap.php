<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Los_Angeles');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}


// request host
$host = preg_replace('/[^\w.]/', '', $_SERVER['HTTP_HOST']);

/**
 * load kohana config manually. we do this because we've
 * broken away from kohana standard by allowing several settings
 * below to be set via config settings (instead of hardcoded
 * here).  This includes Kohana::init(). However, Kohana::init()
 * is what initializes our config in the first place. so we must
 * manually create our config instead before we load init() via 
 * config values
 */
Kohana::$config = new Config;

/**
 * load configs and bootstraps based on environment.
 *
 * Configs
 * Attach multiple file readers to config. The stack is like so...
 * example.com -> development|staging|production -> base -> normal
 * Values from the top of the stack override the lower stack values.
 */
// normal config dir. we won't put anything at this level but modules do. so this is needed.
Kohana::$config->attach(new Config_File('config'));

// base config and include
Kohana::$config->attach(new Config_File('config/base'));
@include_once(APPPATH.'/includes/environments/base.php');

// environment config
switch (Kohana::$environment)
{
	case Kohana::PRODUCTION:
		@include_once(APPPATH.'/includes/environments/production.php');
		Kohana::$config->attach(new Config_File('config/production'));
		break;
	case Kohana::STAGING:
		@include_once(APPPATH.'/includes/environments/staging.php');
		Kohana::$config->attach(new Config_File('config/staging'));
		break;
	case Kohana::DEVELOPMENT:
		@include_once(APPPATH.'/includes/environments/development.php');
		Kohana::$config->attach(new Config_File('config/development'));
		break;
}

// config and bootstrap specific to domain
@include_once(APPPATH.'/includes/environments/'.$host.'.php');
Kohana::$config->attach(new Config_File('config/'.$host));

/**
 * break from kohana norm and allow us to load init values from configs to allow for differences in env's
 */
Kohana::init(Kohana::$config->load('main.init'));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * our secure cookie salt.
 */
Cookie::$salt = Kohana::$config->load('main.cookiesalt');

/**
 * break from kohana norm and allow us to load modules via config
 * settings allowing for different modules in different env's
 */
Kohana::modules(Kohana::$config->load('modules')->as_array());

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 *
 * note that ALL controller classes that are accessible from a request should be accessed
 * from the 'classes/Controller/Route/' directory.
 */
// default route. this should be our last route since it's a catch all.
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'directory' => 'Route',
		'controller' => 'Index',
		'action'     => 'index',
	));
