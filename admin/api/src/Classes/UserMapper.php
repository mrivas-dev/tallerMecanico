<?php
namespace App;
/**
* 
Clase UserMapper 
Es un conjunto de usuarios 
*
**/
class UserMapper extends Mapper
{
	public function getAll( $request,  $response, array $args ) {
		$sess = Session::loggedInfo();
		$db = DBHandler::getHandler();
		$query = "Select * from user";
		$resultado = $db->getAllRecords($query);
		return $response->withJson($resultado);
	}
}