<?php
define('APP_PATH', __DIR__);

$config = require APP_PATH . '/config/config.php';

define('ERROR_LOG', $config['error_log_path']);
define('DEBUG_LOG', $config['debug_log_path']);
define('TITLE', $config['title']);

require APP_PATH . '/function.php';

// exception handler
set_exception_handler('exceptionHandler');

// error handler
set_error_handler('errorHandler');

register_shutdown_function('myShutdown');

// autoload
spl_autoload_register("myAutoLoader");

require APP_PATH . '/config/database.php';

require APP_PATH . '/framework.php';


// route
$front = FrontController::getInstance();
$front->route();
