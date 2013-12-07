<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Reservas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Reservas\Form\Formularios;
use Reservas\Model\Entity\Reservas;
use Zend\Db\Adapter\Adapter;
use Zend\Validator;
use Materiales\Model\Entity\Libros;
use Zend\Session\Container;

class IngresoController extends AbstractActionController
{
	public $dbAdapter;
	
    public function indexAction()
    {	$user_session = new Container('user');
		$id = (string) $this->params()->fromRoute('id', 0);
		$form=new Formularios("form");
		$form->get("oculto")->setAttribute('value', $id);
		$form->get("oculto2")->setAttribute('value', $user_session->rut);
        return new ViewModel(array("id"=>$id,"titulo"=>"Ingresar Reserva","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    }
	public function guardarAction(){
	
	if($this->getRequest()->isPost()){
                
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
            $data = $this->request->getPost();
            $res=new Reservas($data,$this->dbAdapter);
            $res->addReserva();
			return new ViewModel(array('mensaje'=>'Reserva ingresada correctamente'));
	}else{
	return new ViewModel(array('mensaje'=>'Error de sistema'));
	}
   
}
}

?>
