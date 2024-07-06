<?php

namespace DevPhanuel\ApiSimpleMenu;

use Whoops\Handler\JsonResponseHandler;
use Whoops\Run as WhoopsRun;

require_once __DIR__ . '/vendor/autoload.php';

// Whoops catches all exceptions
$whoops = new WhoopsRun;
$whoops->pushHandler(new JsonResponseHandler);
$whoops->register();

require_once 'helpers.php';
require basePath('src/Helpers/headers.inc.php');
require basePath('src/Config/config.inc.php');
require basePath('src/Config/database.inc.php');
require basePath('src/Helpers/misc.inc.php');

require_once basePath('src/Routes/routes.php');
