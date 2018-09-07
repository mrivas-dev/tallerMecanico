<?php
namespace App;
/**
* 
Clase Session para retornar, crear o eliminar sessiones
*
**/
class Session
{
	function __construct($logger)
	{
		$this->logger = $logger;
	}
	function loggedInfo(){
		if (!isset($_SESSION)) {
			session_start();
		}
		$sess = array();
		if(isset($_SESSION['iduser']))
		{
			$sess["iduser"] = $_SESSION['iduser'];
			$sess["nombuser"] = $_SESSION['nombuser'];
		}
		else
		{
			$sess["iduser"] = '';
			$sess["nombuser"] = 'Invitado';
		}
		return $sess;
	}
	function getSession( $request,  $response, array $args ){
		if (!isset($_SESSION)) {
			session_start();
		}
		$sess = array();
		if(isset($_SESSION['iduser']))
		{
			$sess["iduser"] = $_SESSION['iduser'];
			$sess["nombuser"] = $_SESSION['nombuser'];
		}
		else
		{
			$sess["iduser"] = '';
			$sess["nombuser"] = 'Invitado';
		}
		return $response->withJson($sess);
	}
	function destroySession(Request $request, Response $response, array $args){
		if (!isset($_SESSION)) {
			session_start();
		}
		if(isSet($_SESSION['iduser']))
		{
			unset($_SESSION['iduser']);
			unset($_SESSION['nombuser']);
			$info='info';
			if(isSet($_COOKIE[$info]))
			{
				setcookie ($info, '', time() - $cookie_time);
			}
			$msg="Se ha deslogueado satisfactoriamente...";
		}
		else
		{
			$msg = "Lo esta logueado...";
		}
		return $response->withJson($msg);
	}
}
?>