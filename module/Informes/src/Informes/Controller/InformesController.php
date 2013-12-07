<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Informes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Informes\Form\Formularios;
use Zend\View\Model\ViewModel;
use Informes\Model\Entity\Informes;
use Informes\Tcpdf\config\lang\eng;
use Informes\Tcpdf\tcpdf;

class InformesController extends AbstractActionController
{
    public function seleccionAction()
    {
        if($this->getRequest()->isPost())
        {
            ?>
             <script>
                alert('Ha elegido informe de inventario');
                location.href=$this->url.'/informes/informes/inventario';
            </script>
<?php
            $data=$this->getRequest()->isPost();
            //print_r($data);
             //$form=new Formularios("form");
             echo $data['informe'];
            if($data['informe']==1){
               
                ?>
               


<?php
            }
            if($data['informe']==2){
                echo $data['informe'];
            }
            if($data['informe']==3){
                echo $data['informe'];
            }
            if($data['informe']==4){
                echo $data['informe'];
            }
            if($data['informe']==5){
                echo $data['informe'];
            }
            if($data['informe']==6){
                echo $data['informe'];
            }
            if($data['informe']==7){
                echo $data['informe'];
            }



        }else{
        $form=new Formularios("form");
        return new ViewModel(
            array(
                "titulo"=>"Informes",
                "form"=>$form,'url'=>$this->getRequest()->getBaseUrl(),
                ));
    }
    }

    public function inventarioAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $a= new Informes($this->dbAdapter);
        $result=$a->informeinventario();

       return new  ViewModel(array("result"=>$result));
    
    }

    public function morososAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $a= new Informes($this->dbAdapter);
        $result=$a->informemorosos();

       return new  ViewModel(array("result"=>$result));
    
    }
    public function matpresAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $a= new Informes($this->dbAdapter);
        $result=$a->informematpres();

       return new  ViewModel(array("result"=>$result));
    
    }
    public function historicoAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $a= new Informes($this->dbAdapter);
        $result=$a->informehistorico();

       return new  ViewModel(array("result"=>$result));
    
    }
    public function matsolAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $a= new Informes($this->dbAdapter);
        $result=$a->informematsol();

       return new  ViewModel(array("result"=>$result));
    
    }
     public function matsugAction()
    {
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
        $a= new Informes($this->dbAdapter);
        $result=$a->informematsug();

       return new  ViewModel(array("result"=>$result));
    
    }

}
?>