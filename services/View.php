<?php
/**
 * View
 */
class View {
    
    const VIEW_PATH = '/app/views/';

    public $data = array();
    public $view;

    public function __construct($view) {

	$this->view = $view;
    }

    // template
    public static function make($viewName = null) {

	if ( !$viewName ) {
	    throw new InvalidArgumentException("View name can not be empty!");
	}

	$viewFilePath = APP_PATH . self::VIEW_PATH . $viewName .'.php';

	if (!is_file($viewFilePath)) {
	    throw new Exception("View file does not exist!");
	}

	return new View($viewFilePath);
    }

    public function with($key, $value=null) {
	$this->data[$key] = $value;
	return $this;
    }

    public static function process($view) {
	
	if ( !( $view instanceof View ) ) {
	    throw new Exception("\$view must be instanceof View");
	}

	extract($view->data);
	require $view->view;
    }
}
