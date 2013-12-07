<?php

namespace Informes\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Validator\ValidatorInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Formularios extends Form
{
    public $dbAdapter;
    public function __construct($name = null)
     {
        parent::__construct($name);
        
	$fechaini = new Element\Date('fechaini');
	$fechaini
		->setLabel('Fecha de inicio')
		
		->setAttributes(array(
			'min'  => '2012-01-01',
			'max'  => '2020-01-01',
			'step' => '1', // days; default step interval is 1 day
    ))
    ->setOptions(array(
        'format' => 'd-m-Y'
    ));
	$this->add($fechaini);

    $fechafin = new Element\Date('fechafin');
    $fechafin
        ->setLabel('Fecha de fin')
        
        ->setAttributes(array(
            'min'  => '2012-01-01',
            'max'  => '2020-01-01',
            'step' => '1', // days; default step interval is 1 day
    ))
    ->setOptions(array(
        'format' => 'd-m-Y'
    ));
    $this->add($fechafin);

    $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Seleccionar',
                'title' => 'Seleccionar'
            ),
        ));

    $informe = new Element\Select('informe');
     $informe->setLabel('Informe');
     $informe->setValueOptions(array(
             '1'=> 'Informe de inventario',
             '2'=> 'informe de usuarios morosos',
             '3'=> 'Informe de materiales en prestamo',
             '4'=> 'Informe de material mas solicitado',
             '5'=> 'Informe de material sugerido',
             '6'=> 'Informe historico de compras',
             '7'=> 'Informe de acceso al sistema',
     ));
     $this->add($informe);
	
    }
}

?>
