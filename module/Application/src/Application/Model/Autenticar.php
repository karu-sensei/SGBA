<?php

namespace Application\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Session\Container;

class Autenticar
{
	private $usuario;
	private $pass;
	public function __construct($adapter,$datos = array())
	{
		$this->usuario=$datos['usuario'];
		$this->pass=$datos['pass'];
		$this->dbAdapter=$adapter;
	}
	public function autenticar()
	{ 
	$user_session = new Container('user');
	//$user_session->setExpirationSeconds(10);
	$sql = "select * from usuarios where rut='".$this->usuario."' and password='".$this->pass."'"; 
	$resultado = $this->dbAdapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
	$resultado=$resultado->toArray();
	if($resultado){
	$row=$resultado[0];
	//print_r($resultado);
	//$row=pg_fetch_array($resultado);
	if($row["rut"])
	{
			$user_session->rut=$row["rut"];
			$user_session->nombre=$row["nombre"];
			$user_session->tipo=$row["tipo_usuario_nombre"];
			if($user_session->tipo=="Administrador"){				
				header("Location: ../../usuarios/ingreso");
				}
		    else{
			header("Location: ../login/index");
			}
	
	}
	}
	else{
    echo " <script language='JavaScript'> 
               alert('Error en los datos ingresados !!! '); 
			   document.location='../login/index'; 
                </script>";
		}
		//return "hola";
	}
	public function logout()
	{
	$user_session = new Container('user');
	$user_session->setExpirationSeconds(1);
	
	
	
	}
	
}