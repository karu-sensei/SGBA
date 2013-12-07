<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Encuestas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Encuestas\Form\Formularios;
use Encuestas\Model\Entity\Encuestas;


class IndexController extends AbstractActionController
{
	public $dbAdapter;
    public $dbAdapter2;
	
    public function indexAction()
    {
        $form=new Formularios("form");
        return new ViewModel(
            array(
                "titulo"=>"Sugerir Materiales",
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl()
                )); 
}
    public function guardarAction()
    {
        if($this->getRequest()->isPost()){
                
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
            $data = $this->request->getPost();
            $u=new Encuestas($data,$this->dbAdapter);
            $u->ingresarEncuesta();
            return new ViewModel(array('mensaje'=>'Sugerencia enviada correctamente'));
    }else{
    return new ViewModel(array('mensaje'=>'Error de sistema'));
     }
    }

}
