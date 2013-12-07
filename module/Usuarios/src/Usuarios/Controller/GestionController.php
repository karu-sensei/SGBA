<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Formularios;
use Usuarios\Model\Entity\Tipousuario;
use Usuarios\Model\Entity\Carreras;
use Zend\Db\Adapter\Adapter;

class GestionController extends AbstractActionController
{
    public function tipousuAction()
    {
	$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
    	$form=new Formularios("form",$this->dbAdapter);
        return new ViewModel(array("titulo"=>"Ingresar tipo de usuario","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    }
    
    public function guardatipoAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $data = $this->request->getPost();
        $t=new tipousuario($data,$this->dbAdapter);
        $t->addTipo();

        return new ViewModel(array("mensaje"=>"Tipo de usuario ingresado correctamente"));
    }

    public function carrerasAction()
    {
       $form=new Formularios("form");
       return new ViewModel(array("titulo"=>"Ingresar Carrera","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    }
     public function guardacarreraAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $data = $this->request->getPost();
        $t=new Carreras($data,$this->dbAdapter);
        $t->addCarrera();

        return new ViewModel(array("mensaje"=>"Carrera ingresada correctamente"));
    }
    public function eliminarcarreraAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $result2=$this->dbAdapter->query("select nombre from Carreras",Adapter::QUERY_MODE_EXECUTE);

        $typeahead_string = '[';
        foreach ($result2 as $nombre)
        {
            $formatted_name    = '"'.$nombre["nombre"].'",';
            $formatted_name= (string) $formatted_name;
            $typeahead_string .= $formatted_name; 
        }
        
        //echo $typeahead_string;
        $option_list = rtrim($typeahead_string, ",");
        $option_list .=']';
        $form=new Formularios("form",$this->dbAdapter);
        $form->get('nombre_carrera')->setAttribute('data-source',$option_list);


        return new ViewModel(array("titulo"=>"Eliminar Carrera","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
        
    }

    public function eliminacarreraAction()
    {
        if($this->request->getPost()){
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $data = $this->request->getPost();
        $t=new Carreras($data,$this->dbAdapter);
        $t->eliminarCarrera($data['nombre_carrera']);
        return new ViewModel(array("mensaje"=>"Carrera eliminada de la base de datos"));
        }

    }


}
