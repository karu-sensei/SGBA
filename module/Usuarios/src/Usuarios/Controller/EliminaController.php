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
use Usuarios\Model\Entity\Usuarios;
use Zend\Db\Adapter\Adapter;
use Zend\Session\Container;

class EliminaController extends AbstractActionController
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
    public function eliminarAction()
    {     
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
		$form=new Formeditar("formeditar",$this->dbAdapter);
		if($this->getRequest()->isPost()){
		$data = $this->request->getPost();
		if($data['buscar']){
		$u= new Usuarios($data,$this->dbAdapter);
		//$datos=$u->buscarusuario($data['buscar_usuario']);
		$form->get("oculto")->setAttribute('value', $data['buscar_usuario']);
		return new  ViewModel(array(
                "titulo"=>"Eliminar Usuarios",
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),'datos'=>$u->buscarusuario($data['buscar_usuario'])))
                ;
		}else{
		echo "<script language='Javascript'> 
		confirmar=confirm('¿Confirma que desea eliminarlo?'); 
		if (confirmar){ alert('Usuario eliminado correctamente');
		document.location='../elimina/index';"; 
		//$data = $this->request->getPost();
		$u= new Usuarios($data,$this->dbAdapter);
		$u->eliminarUsuario($data['oculto']);
		//echo "hola";
		echo "}else{ 
		// si pulsamos en cancelar
		document.location='../elimina/index';
		} 
		</script>";
		}


		
    }

}
}


