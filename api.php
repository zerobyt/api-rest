<?php
require_once('rest.php');

/* File : rest.php
 * Author : Arun Kumar Sekar
 */

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

		//JSON Encode Array
		private function json($data){
				if(is_array($data)){
						return json_encode($data);
				}
		}

    /* TEST */
    private function users(){ //PATH_TO_DIR/users

        //Validando el tipo de solicitud
        if($this->get_request_method() != "GET"){
            $this->response('',405);
        }
				$result = array(
            array("code" => "1","name" => "Josh", "birthdate" => "1983-12-08"),
            array("code" => "2","name" => "John", "birthdate" => "1983-09-26"),
            array("code" => "3","name" => "David", "birthdate" => "1983-11-09")
        );
				$this->response($this->json($result), 200);//RESPUESTA DESDE ARRAY
    }

}

// Inicializando API
$api = new API;
$api->processApi();
