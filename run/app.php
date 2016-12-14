<?php date_default_timezone_set('America/Los_Angeles');

  error_reporting(-1);
  ini_set('display_errors', 1);

require dirname(__DIR__) . '/vendor/autoload.php';

define('ENV_MODE', getenv('ENV_MODE') ? getenv('ENV_MODE') : 'Dev');
define('ENV_FILE', dirname(__DIR__) . '/config/' . (getenv('APP_ENV') ?: 'config') . '.json');
define('APP_PATH', dirname(__DIR__));

define('CONF_DIR', APP_PATH . '/config');

$payload =
  [
    'type' => (! isset($argv) ?: 0),
    'args' => (! isset($argv) ? $_GET : $argv),
  ];

$bootstrap = New \Helpers\Bootstrap($payload);
$bootstrap->run();
