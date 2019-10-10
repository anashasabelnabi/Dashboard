<?php
/*
 *app core class
 *create url and loads core controller
 *url formate - controller/method/params
*/
class Core{

// lw mfe4 ay controller yb2a elcontroller elhy7slo rediect esmo pages
	protected $current_controller = 'dashboards';
	protected $currentMethod = 'index';
	protected $params = [];


	public function __construct(){
		//print_r($this->geturl());
		$url = $this->geturl(); 

		//look in controllers for first value
		if (file_exists('../app/controllers/' .$url[0]. '.php')) {
			 //lw elcontroller mwgod 7to ka controlleer
			$this->current_controller = ucwords($url[0]);
			//unset  0 index aw elcontroller da hl8i
			unset($url[0]);
		}

		// require the controller 
		require_once '../app/controllers/' .$this->current_controller. '.php';

		//instantiate controller class 
		$this->current_controller = new $this->current_controller;

		//check for the second part elhwa methods
		if (isset($url[1])) {
			
			//check for the method exixst in controller
			if (method_exists($this->current_controller, $url[1])) {
				$this->currentMethod = $url[1] ;
				unset($url[1]);
				

			}	
		}

		//get params mmkn yb2a feha 7aga aw mmkn tfdl array fadia
		$this->params = $url ? array_values($url) : [];
		//var_dump($this->params);

		// call a callback whith array of params htrg3 array elfeha elparams
		call_user_func_array([$this->current_controller,$this->currentMethod],$this->params);
	}

	//method 34an tgeb el url we n7oto fe array
	public function geturl(){
	if (isset( $_GET['url'])) {

		$url = rtrim($_GET['url'], '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		//b2sm el url bbta3y kol 7aga lw7dha a7otha fe array
		$url = explode('/' , $url);
		return $url ;
	 	
	 }
	}
}