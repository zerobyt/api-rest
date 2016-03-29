<?php
require_once('rest.php');
	
	class API extends REST{
    
    /*
    *Función que se invoca automáticamente cuando se instancia la clase API
    */
    public function __construct(){
        //Inicializando variables locales
        parent::__construct();
    }
    
    //Accediento al API
    public function processApi() {
        //Parseando la URL
        $func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
        
        //Validando la existencia del método
        if((int)method_exists($this,$func) > 0){
            $this->$func();
        }else{
            $this->response('',404);
        }
    }
    
    
    private function users(){
        
        //Validando el tipo de envío
        if($this->get_request_method() != "POST"){
            $this->response('',405);
        }
        
        //Define los valores recibidos
        $type = $this->_request['type'];
		//$this->response($this->json($result), 200);
 
    }

    //JSON Encode Array
    private function json($data){
        if(is_array($data)){
            return json_encode($data);
        }
    }
}

// Inicializando API
$api = new API;
$api->processApi();