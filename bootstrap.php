<?php
define('APP_PATH', __DIR__);

$config = require APP_PATH . '/config/config.php';

define('ERROR_LOG', $config['error_log_path']);

require APP_PATH . '/config/database.php';

require APP_PATH . '/framwork.php';

require APP_PATH . '/function.php';

// exception handler
set_exception_handler('exceptionHandler');

// error handler
set_error_handler('errorHandler');


// autoload
spl_autoload_register("myAutoLoader");

// route
$front = FrontController::getInstance();
$front->route();
