<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Formularios;
use Zend\View\Model\ViewModel;
use Application\Model\Autenticar;
use Zend\Session\Container;
use Zend\Authentication\AuthenticationService;

class LoginController extends AbstractActionController
{
    public function indexAction()
    {
	if($this->getRequest()->isPost())
        {
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $data = $this->request->getPost();
		$a= new autenticar($this->dbAdapter,$data);
		$b=$a->autenticar();
		//return new viewmodel(array("a"=>$b));
		
		}else{
            $form=new Formularios("form");
        return new ViewModel(
            array(
                "titulo"=>"Login",
				//"a"=>$b,
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),
                ));
				}
    }
	public function logoutAction() {
	$user_session = new Container('user');
	$user_session->setExpirationSeconds(1);
    //Zend_Auth::getInstance()->clearIdentity();
}
}

