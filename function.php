<?php
// exception handler
function exceptionHandler($exception) {
    $exceptionMessage = "";
    $exceptionMessage .= "[" . date("m-d H:i:s") . "] " . $exception->getMessage()."\n";
    if (isset($_REQUEST)) {
	$exceptionMessage .= "REQUEST: " . print_r($_REQUEST,true) . "\n";
	$exceptionMessage .= "REQUEST_URI: " . print_r($_SERVER['REQUEST_URI'],true) . "\n\n";
    }

    error_log($exceptionMessage, 3, ERROR_LOG);

    exit;
}

// error handler 
function errorHandler($errno, $errstr, $errfile, $errline) {

    $errorMessage = "";
    $errorMessage .= "[" . date("m-d H:i:s") . "] [" . $errno . " " . $error . "\n";
    $errorMessage .= "Error on line ". $errline . " in " . $errfile . "\n\n";
    if (isset($_REQUEST)) {
	$errorMessage .= "REQUEST: " . print_r($_REQUEST,true) . "\n";
	$errorMessage .= "REQUEST_URI: " . print_r($_SERVER['REQUEST_URI'],true) . "\n\n";
    }

    error_log($errorMessage, 3, ERROR_LOG);

    exit;
    
}

// shutdown function
function myShutdown() {
    
    if (error_get_last()) {
	error_log( "[" . date("m-d H:i:s") . "]" . print_r(error_get_last(), true) . "\n\n", 3, ERROR_LOG);
    }
}

// autoload function
function myAutoLoader($class) {
    
    if (strstr($class, 'controller')) {
	require APP_PATH . '/app/controllers/' . $class . 'Controller.php';
    } else if ( strstr($class, 'Model') ) {
	require APP_PATH . '/app/models/' . $class . 'Model.php';
    } else {
	require APP_PATH . '/services/' . $class . '.php';
    }
}
