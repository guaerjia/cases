<?php

class IndexController extends BaseController {

    public function index() {
	echo "hello, world!"; 
    }

    public function test() {
    
	$view = View::make('index')->with('name', 'guan')
	    ->with('arr', array('wang','li','guan','sui'))
	    ->with('title', '我是中文');

	//$view = View::make('index');
	View::process($view);
    }
}
