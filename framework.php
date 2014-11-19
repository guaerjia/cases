<?php
/**
 *  控制器
 * 
 */

class FrontController {
    
    protected $_controller, $_action, $_params, $_body;
    static $_instance;

    public static function getInstance() {
	if ( !(self::$_instance instance of self) ) {
	    self::$_instance = new self();
	}
	return self::$_instance;
    }

    private function __construct() {
    
	// 根据REQUEST_URI来获取路由
	$path = $_SERVER['REQUEST_URI'];

	$path = strpos($path,'?')>0 ? substr($path, 0, strpos($path, '?')) : $path;

	$splits = explode('/', trim($path,'/'));

	$this->_controller = !empty($splits[0]) ? $splits[0] : 'indexController';
	$this->_action = !empty($splits[1]) ? $splits[1] : 'index';

    }


    public function route() {

	if (!preg_match('/^[a-zA-Z_-]$/',$this->_controller)) {
	    throw new Exception("controller:" . $this->_controller . " is not illegal.";
	}

	if (!preg_match('/^[a-zA-Z_-]$/',$this->_action)) {
	    throw new Exception("action:".$this->_action . " is not illegal.";
	}
	
	if (class_exists($this->_controller)) {
	    $rc = new ReflectionClass($this->_controller);
	    if ($rc->hasMethod($this->_action)) {
		$method = $rc->getMethod($this->_action);
		$method->invoke($rc->newInstance());
	    } else {
		throw new Exception("no action");
	    }
	} else {
	    throw new Exception("no controller");
	}
    }

    public function getController() {
	return $this->_controller;
    }

    public function getAction() {
	return $this->_action;
    }
}
