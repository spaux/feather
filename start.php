<?php

use Illuminate\Filesystem;
use Illuminate\Config\FileLoader;

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let's turn on the lights.
| This bootstraps the framework and gets it ready for use, meaning
| it just loads a couple of files that can not be handled by the
| class loader automatically generated by the Composer loaders.
|
*/

$app = Illuminate\Foundation\Lightbulb::on();

/*
|--------------------------------------------------------------------------
| Define The Application Path
|--------------------------------------------------------------------------
|
| Here we just defined the path to the application directory. Most likely
| you will never need to change this value as the default setup should
| work perfectly fine for the vast majority of all our applications.
|
*/

$app['path'] = __DIR__.'/app';

$app['path.base'] = __DIR__;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name or HTTP host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$app->detectEnvironment(array(

	'local' => array('localhost', '*.dev', '*.app'),

));

/*
|--------------------------------------------------------------------------
| Check For The Test Environment
|--------------------------------------------------------------------------
|
| If the "unitTesting" variable is set, it means we are running the unit
| tests for the application and should override this environment here
| so we use the right configuration. The flag gets set by TestCase.
|
*/

if (isset($unitTesting)) $app['env'] = $testEnvironment;

/*
|--------------------------------------------------------------------------
| Register The Configuration Loader
|--------------------------------------------------------------------------
|
| The configuration loader is responsible for loading the configuration
| options for the application. By default we'll use the "file" loader
| but you are free to use any custom loaders with your application.
|
*/

$app['config.loader'] = $app->share(function($app)
{
	$path = $app['path'].'/config';

	return new FileLoader(new Filesystem, $path);
});

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load the Illuminate application. We keep this is in
| a separate location so we can isolate the creation of the it
| from the actual running of the application, allowing us
| to easily test and inspect the application outside
| of a web request context such as with PHPUnit.
|
*/

require __DIR__.'/vendor/illuminate/foundation/src/start.php';

return $app;