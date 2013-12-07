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
use Usuarios\Model\Entity\Tipousuario;
use Zend\Db\Adapter\Adapter;

class EditatipoController extends AbstractActionController
{
	public $dbAdapter;

    public function indexAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $result2=$this->dbAdapter->query("select nombre from tipo_usuario",Adapter::QUERY_MODE_EXECUTE);

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
        $form->get("nombre_tipo")->setAttribute('data-source',$option_list);
        return new ViewModel(
            array(
                "titulo"=>"Buscar Tipo_usuario",
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),
                ));
        
    
    }
    public function editarAction()
    {
	$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $form=new Formularios("form",$this->dbAdapter);
        
        $data = $this->request->getPost();
        $u= new Tipousuario($data,$this->dbAdapter);
		$sql="select * from tipo_usuario where nombre='".$data['nombre_tipo']."'";
        $result=$this->dbAdapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
		$result=$result->toArray();
        $result=$result[0];
		//foreach ($result as $nombre){
        //echo $data['nombre_tipo'];
		$form->get('registro_usuario')->setValue($result['registro_usuarios']);
        $form->get('reservas_material')->setValue($result['reservas_material']);
        $form->get('multas_material')->setValue($result['multas_material']);
        $form->get('emision_informes')->setValue($result['emision_informes']);
        $form->get('registro_prestamos')->setValue($result['registro_prestamos']);
        $form->get('admin_material')->setValue($result['admin_material']);
		print_r($result);
		//}//
        $form->get("oculto")->setAttribute('value', $data['nombre_tipo']);
        return new  ViewModel(array(
                "titulo"=>"Editar Tipo de usuario",
				"nombre"=>$data['nombre_tipo'],
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),'datos'=>$u->buscartipo($data['nombre_tipo'])
                ));
        //return new ViewModel();



    }
	
    public function modificarAction()
    {
        
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $data = $this->request->getPost();
        $u= new Tipousuario($data,$this->dbAdapter);
        

        if (strcmp($data['send'],'Guardar')==0) {
            $u->updatetipo($data['oculto']);
            $men='Cambios realizados correctamente';
        }
        if (strcmp($data['eliminar'],'Eliminar')==0) {
            $u->eliminartipo($data['oculto']);
            $men='Tipo de usuario eliminado de la base de datos';
        }


        return new ViewModel(array('mensaje'=>$men));
    }
}
