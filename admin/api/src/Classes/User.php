<?php
namespace App;
/**
* 
Clase User 
*
**/
class User
{
	protected $id;
	protected $nombre;
	protected $tipo;
	protected $path;
	protected $contra;
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct($logger) {$this->logger = $logger;}

    function newUser(array $data){
    	$this->id = $data['iduser'];
    	$this->nombre = $data['nombuser'];
    	$this->path = $data['path'];
    	$this->tipo = $data['tipouser'];
    	$this->contra = $data['contuser'];

    }
    public function getId() {
    	return $this->id;
    }
    public function getName() {
    	return $this->nombre;
    }
    public function getTipo() {
    	return $this->tipo;
    }
    public function getPath() {
    	return $this->path;
    }
    public function getPass() {
    	return $this->contra;
    }

    public function update($request, $response, array $args){
    	$sess = Session::loggedInfo();
    	$db = DBHandler::getHandler();
    	$usuario = $request->getParsedBody();
    	if(isset($usuario['contuser'])){$usuario['contuser'] =  PasswordHash::hash($usuario['contuser']);}
    	$condition = array('iduser' => $usuario['iduser']);
    	$update = $db->update("user", $usuario,$condition);
    	if($update){
    		if($sess['iduser']==$usuario['iduser']){
    			$this->logger->addInfo("Actualizacion de datos propios | ".$sess["nombuser"] );  
    		}else{
    			$this->logger->addInfo("Actualización de usuario con ID:".$usuario['iduser']." | ".$sess["nombuser"] );  
    		}
    		$rta['status'] = "success";
    		$rta['message'] = "El usuario se ha actualizado satisfactoriamente";
    	}else{
    		$rta['status'] = "error";
    		$rta['message'] = "Error al actualizar usuario. Revise los campos.";
    	}
    	return $response->withJson($rta);
    }
    public function getMe( $request,  $response, array $args ){
    	$sess = Session::loggedInfo();
    	$db = DBHandler::getHandler();
    	$query = "Select * from user where iduser = ".$sess['iduser'];
    	$result = $db->getOneRecord($query);
    	if($result){
    		$rta = $result;
    	}
    	return $response->withJson($rta);
    }
    public function save($request, $response, array $args){
    	$sess = Session::loggedInfo();
    	$db = DBHandler::getHandler();
    	$usuario = $request->getParsedBody();
    	$uploadedFiles = $request->getUploadedFiles();
      $uploadedFile = $uploadedFiles['imagen'];
       print_r($uploadedFiles);
    	$usuario['contuser'] = PasswordHash::hash($usuario['contuser']);
    	//$result = $db->insert('user', $usuario);
    	if($result){
    		$rta['status'] = "success";
    	}else{
    		$rta['status'] = "error";

    	}
    	return $response->withJson($rta);
    }
    public function delete($request, $response, array $args){
    	$sess = Session::loggedInfo();
    	$db = DBHandler::getHandler();
    	$ide = $args['iduser'];
    	$condition = array('iduser' => $ide);
    	if($sess['iduser']==$ide){
    			$rta['status'] = "warning";
    			$rta['message'] = "No puede eliminarse a si mismo.";
    	}else{
    		if($sess['iduser']){
    			$delete = $db->delete("user", $condition);
    			$this->logger->addInfo("Eliminación de usuario | ".$sess["nombuser"] );  
    		}
    		if($delete){
    			$rta['status'] = "success";
    			$rta['message'] = "El usuario ha sido eliminado.";
    		}else{
    			$rta['status'] = "error";
    			$rta['message'] = "Hubo un error al eliminar el usuario.";
    		}	
    	}
    	return $response->withJson($rta);
    }
  }