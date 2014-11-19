<?php
class BaseController {
    protected $db;

    function __construct() {
	global $front;

	// db init
	$this->db = null;

	// do something else
    }
}
