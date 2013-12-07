<?php
namespace Materiales\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Materiales\Form\Formularios;
use Materiales\Model\Entity\Libros;
use Zend\Db\Adapter\Adapter;
use Materiales\Model\Entity\Revistas;
use Materiales\Model\Entity\Tesis;

class BuscarController extends AbstractActionController
{
    public $dbAdapter;
    public function indexAction()
    {
        return new ViewModel();
    }
    public function buscarAction()
		{
		 $form=new Formularios("form",$this->dbAdapter);           
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
		$result=$this->dbAdapter->query("select * from tipo_material",Adapter::QUERY_MODE_EXECUTE);
		
		$selectData = array();
 
        foreach ($result as $res) {
            $selectData[$res['nombre']] = $res['nombre'];
        }
        $selectData2 = array();
		
        
		$form->get("tipo")->setOptions(array('value_options'=>$selectData));  
        return new ViewModel(array("titulo"=>"buscar material","form"=>$form,'url'=>$this->getRequest()->getBaseUrl()));
    
    }
    public function mostrarAction()
    {
        if($this->getRequest()->isPost()){
            $data = $this->request->getPost();   
            $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
			$sql= "select * from materiales 
            where ".$data['parametro']." like '%".$data['palabra']."%' and 
            tipo_material_nombre='".$data['tipo']."' and idioma= '".$data['idioma']."'" ;
            $result2=$this->dbAdapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
			$result2=$result2->toArray();
            return new ViewModel(array('titulo'=>'Resultados de busqueda','datos'=>$result2));
    }else
    return new ViewModel(array('titulo'=>'Resultado de busqueda'));
    }

}