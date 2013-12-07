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
use Usuarios\Form\Formularios;
use Usuarios\Model\Entity\Usuarios;
use Zend\Db\Adapter\Adapter;
use Zend\Validator;
use Zend\Session\Container;

class IngresoController extends AbstractActionController
{
	public $dbAdapter;
	
    public function indexAction()
    {
	$user_session = new Container('user');
	$tipo=$user_session->tipo;
	//if($tipo=="Administrador"){				
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
		$form=new Formularios("form",$this->dbAdapter);
		if($this->getRequest()->isPost()){
			$result=$this->dbAdapter->query("select * from tipo_usuario",Adapter::QUERY_MODE_EXECUTE);
		
		$selectData = array();
 
        foreach ($result as $res) {
            $selectData[$res['nombre']] = $res['nombre'];
        }
        $selectData2 = array();
		$form->get("tipo")->setOptions(array('value_options'=>$selectData));

		$result2=$this->dbAdapter->query("select * from carreras",Adapter::QUERY_MODE_EXECUTE);
        foreach ($result2 as $res2) {
            $selectData2[$res2['nombre']] = $res2['nombre'];
        }
		$form->get("carrera")->setOptions(array('value_options'=>$selectData2));
             $data = $this->request->getPost();
             $form->setData($data);
             if($form->isValid()){   
            
            $u=new Usuarios($data,$this->dbAdapter);
            
            $result3= '<div class="alert alert-success alert-dismissable">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>succes</strong><h1>Usuario Ingresado correctamente</h1>.
		</div>';
            $u->addUsuario($data);
			$form->reset();

			//$form->get('guardar')->setAttributes(array('type','reset'));

		}else
		    $result3= '<div class="alert alert-error alert-dismissable">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>Error</strong> <h2>formulario invalido.</h2>
		</div>';
			
            //return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuarios/ingreso');
	   }else{	
	   	$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
		$form=new Formularios("form",$this->dbAdapter);
		
		$result=$this->dbAdapter->query("select * from tipo_usuario",Adapter::QUERY_MODE_EXECUTE);
		
		$selectData = array();
 
        foreach ($result as $res) {
            $selectData[$res['nombre']] = $res['nombre'];
        }
        $selectData2 = array();
		$form->get("tipo")->setOptions(array('value_options'=>$selectData));

		$result2=$this->dbAdapter->query("select * from carreras",Adapter::QUERY_MODE_EXECUTE);
        foreach ($result2 as $res2) {
            $selectData2[$res2['nombre']] = $res2['nombre'];
        }
		$form->get("carrera")->setOptions(array('value_options'=>$selectData2));
				
		$form->setInputFilter($form->getInputFilter());
	       }
		    /*}else{
			echo " <script language='JavaScript'> 
               alert('Debe logear para acceder a esta pantalla o no tiene los permisos correspondientes'); 
			   document.location='../application/login'; 
                </script>";
		}*/
		$reult3="";

		
		//$a=$user_session->nombre;

		
		

        return new ViewModel(array("result3"=>$result3,"titulo"=>"Ingresar Usuarios","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    
    }
	}
    
