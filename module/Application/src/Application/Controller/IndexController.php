<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class IndexController extends AbstractActionController
{
	public $dbAdapter;
	
    public function indexAction()
    {
        return new ViewModel();
    }
	 public function resultAction()
    {
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
		//var_dump($this->dbAdapter);
		$result=$this->dbAdapter->query("select * from test order by clave desc",Adapter::QUERY_MODE_EXECUTE);
		$datos=$result->toArray();
        return new ViewModel(array('texto'=>'conectando a postgresql usando un resultset',"datos"=>$datos));
    }
	public function sqlAction(){
	$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
	$sql = new Sql($this->dbAdapter);
	$select = $sql->select();
	$select->from('test');
	//$select->where(array('clave' => 'qwerty'));
	//$select->order('clave desc')

	$selectString = $sql->getSqlStringForSqlObject($select);
	//echo $selectString;
	$result = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
		$datos=$result->toArray();
        return new ViewModel(array('texto'=>'conectando a postgresql usando un sql',"datos"=>$datos));
	}
 
}
