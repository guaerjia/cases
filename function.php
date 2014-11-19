<?php
// exception handler
function exceptionHandler($exception) {
    $exceptionMessage = "";
    
    $exceptionMessage .= "[" . date("m-d H:i:s") . "] " . $exception->getMessage()."\n";
    $exceptionMessage .= "Exception on line ". $exception->getLine() . " in " . $exception->getFile() . "\n";
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
    $errorMessage .= "[" . date("m-d H:i:s") . "] [" . $errno . " " . $errstr . "\n";
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
    
    $class = ucfirst($class);

    if (strstr($class, 'Controller')) {
	require APP_PATH . '/app/controllers/' . $class . '.php';
    } else if ( strstr($class, 'Model') ) {
	require APP_PATH . '/app/models/' . $class . '.php';
    } else {
	require APP_PATH . '/services/' . $class . '.php';
    }
}


// debug
function myLog($message) {

    $debug = debug_backtrace();
    $call_info = array_shift( $debug );
    $code_line = $call_info['line'];
   	
    $function = isset($debug[0]['function']) ? $debug[0]['function'] : '';
   	
    $exploded = explode('/', $call_info['file']);
    $file = array_pop( $exploded );
	
    if (is_object($message)) {
	$message = (array) $message;
    }
 	
    if (is_array($message)) {
    	$message = print_r($message, true);
    }
    
    error_log("[".date("m-d H:i:s") . ' ' .$file.' '.$code_line.' '.$function."] ".$message."\n", 3, DEBUG_LOG);

}
