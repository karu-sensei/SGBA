<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Materiales\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Materiales\Form\Formularios;
use Materiales\Model\Entity\Libros;
use Zend\Db\Adapter\Adapter;
use Materiales\Model\Entity\Revistas;
use Materiales\Model\Entity\Tesis;

class IngresoController extends AbstractActionController
{
    public $dbAdapter;
    public function libroAction()
    {

        $form=new Formularios("form");
        return new ViewModel(array("titulo"=>"Ingresar libro","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    
    }
    public function guardalAction()
    {
        if($this->getRequest()->isPost()){
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
                
            $data = $this->request->getPost();
            $l=new Libros($data,$this->dbAdapter);
            $l->addLibro();
           
            return new ViewModel(array('mensaje'=>'Libro ingresado correctamente'));
            //return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuarios/ingreso');
    }else
    return new ViewModel(array('mensaje'=>'Error de sistema'));
    }
    

    public function tesisAction()
    {

        $form=new Formularios("form");
        return new ViewModel(array("titulo"=>"Ingresar tesis","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    
    }
    public function guardatAction()
    {

         if($this->getRequest()->isPost()){
                
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
            $data = $this->request->getPost();
            $t=new Tesis($data,$this->dbAdapter);
            $t->addTesis();
            return new ViewModel(array('mensaje'=>'Tesis ingresada correctamente'));
    }else
    return new ViewModel(array('mensaje'=>'Error de sistema'));
    }

    public function revistaAction()
    {

        $form=new Formularios("form");
        return new ViewModel(array("titulo"=>"Ingresar revista","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    
    }
    public function guardarAction()
    {
        if($this->getRequest()->isPost()){
                
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
            $data = $this->request->getPost();
            $r=new Revistas($data,$this->dbAdapter);
            $r->addRevista();
            return new ViewModel(array('mensaje'=>'Revista ingresada correctamente'));
            //return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuarios/ingreso');
    }else
    return new ViewModel(array('mensaje'=>'Error de sistema'));
    }

}
