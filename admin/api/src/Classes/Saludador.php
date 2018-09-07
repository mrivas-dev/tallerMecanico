<?php
namespace App;
	/**
	 La clase mas fashion
	 **/
	 class Saludador{

	 	function __construct($logger)
	 	{
	 		$this->logger = $logger;
	 	}
	 	function hola( $request,  $response, array $args) {
	 		$name = $args['name'];
	 		$this->logger->addInfo('Saludo '.$name);
	 		$rta = "Hello, $name";
	 		return $response->withJson($rta);
	 	}
}

?>
