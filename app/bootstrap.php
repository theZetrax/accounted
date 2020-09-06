<?php

# Noodlehous [config]
use Noodlehaus\Config;
# Slim
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

# Respect
use Respect\Validation\Factory;

use Accounted\User\User;
use Accounted\Mail\Mailer;
use Accounted\Helpers\Hash;
use Accounted\Middleware\BeforeMiddleware;

use RandomLib\Factory as RandomLib;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
	'mode' => file_get_contents( INC_ROOT . '/mode.php' ),
	'view' => new Twig(),
	'templates.path' => INC_ROOT . '/app/views'
]);

$app->add(new BeforeMiddleware);

$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load( INC_ROOT . "/app/config/{$app->mode}.php" );
});

require __DIR__ . '\\database.php';
require __DIR__ . '\\routes.php';

$app->auth = false;

$app->container->set('user', function() {
	return new User();
});

$app->container->singleton('randomlib', function() use ($app) {
	$factory = new RandomLib;
	return $factory->getMediumStrengthGenerator();
});

$app->container->singleton('hash', function() use ($app) {
	return new Hash($app->config);
});

$app->container->singleton('mail', function() use ($app) {
	$mailer = new PHPMailer;

	$mailer->Host = $app->config->get('mail.host');
	$mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
	$mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
	$mailer->Port = $app->config->get('mail.port');
	$mailer->Username = $app->config->get('mail.username');
	$mailer->Password = $app->config->get('mail.password');
	
	$mailer->isHTML($app->config->get('mail.html'));

	return new Mailer($app->view, $mailer);
});

/** @var \Slim\View */
$view = $app->view();

$view->parserOptions = [
	'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [
	new TwigExtension
];

# Configuring Respect\Validation
# to include custom rules
Factory::setDefaultInstance(
	(new Factory())
		->withRuleNamespace('Accounted\\Validation\\Rules')
		->withExceptionNamespace('Accounted\\Validation\\Exceptions')
);
