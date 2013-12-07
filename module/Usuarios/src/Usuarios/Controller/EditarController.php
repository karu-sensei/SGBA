<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Formeditar;
use Usuarios\Model\Entity\Procesa;
use Usuarios\Model\Entity\Usuarios;
use Zend\Db\Adapter\Adapter;
use Zend\Session\Container;

class EditarController extends AbstractActionController
{
	public $dbAdapter;
	public $datos;

    public function indexAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $result2=$this->dbAdapter->query("select rut from usuarios",Adapter::QUERY_MODE_EXECUTE);

        $typeahead_string = '[';
        foreach ($result2 as $rut)
        {
            $formatted_name    = '"'.$rut["rut"].'",';
            $formatted_name= (string) $formatted_name;
            $typeahead_string .= $formatted_name; 
        }
        
        //echo $typeahead_string;
        $option_list = rtrim($typeahead_string, ",");
        $option_list .=']';
        $form=new Formeditar("formeditar",$this->dbAdapter);
        $form->get("buscar_usuario")->setAttribute('data-source',$option_list);
        return new ViewModel(
            array(
                "titulo"=>"Buscar Usuarios",
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl()
                ));
        
    
    }
    public function editarAction()
    {     
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $form=new Formeditar("formeditar",$this->dbAdapter);
		$data = $this->request->getPost();
		if($this->getRequest()->isPost()){
		if($data['buscar']){
		$u= new Usuarios($data,$this->dbAdapter);
		$datos=$u->buscarusuario($data['buscar_usuario']);
		//print_r($datos);
		 $form->get('nombre')->setAttribute('value', $datos[0]["nombre"]);
		 $form->get('direccion')->setAttribute('value', $datos[0]["direccion"]);
		 $form->get('fono')->setAttribute('value', $datos[0]["telefono"]);
		 $form->get('celular')->setAttribute('value', $datos[0]["telefono_movil"]);
		 $form->get('correo')->setAttribute('value', $datos[0]["mail"]);
		 $form->get('rut')->setAttribute('value', $datos[0]["rut"]);
		 $form->get('respuesta')->setAttribute('value', $datos[0]["respuesta_secreta"]);
		 $form->get('password')->setAttribute('value', $datos[0]["password"]);
		 $form->get('confirmar')->setAttribute('value', $datos[0]["password"]);
		 $form->get('matricula')->setAttribute('value', $datos[0]["matricula"]);
		     
		 $form->setInputFilter($form->getInputFilter());
        
        $form->get("oculto")->setAttribute('value', $data['buscar_usuario']);
		return new  ViewModel(array(
                "titulo"=>"Editar Usuarios",
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl()))
                ;
    }
	if($data["send"]){
        $data = $this->request->getPost();
		//$form->setInputFilter($form->getInputFilter());
		$form->setData($data);
		$u= new Usuarios($data,$this->dbAdapter);
		if($form->isValid()){
        $u= new Usuarios($data,$this->dbAdapter);
        $u->updateUsuario($data['oculto']);
		$men='<div class="alert alert-success alert-dismissable">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>succes</strong><h1>Datos modificados correctamente</h1>.
		</div>';
		}else{
		$men='<div class="alert alert-error alert-dismissable">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>error</strong><h1>Formulario Invalido</h1>.
		</div>';
		}
		$a=$form->isValid();
        return new ViewModel(array('titulo'=>'Editar Usuarios','form'=>$form,'mensaje'=>$men,'a'=>$a,'url'=>$this->getRequest()->getBaseUrl()));
	}
}
}
}

