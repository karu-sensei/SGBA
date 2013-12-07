<?php

namespace Reservas\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Validator\ValidatorInterface;
use Zend\Db\Adapter\Adapter;
//use Application\Modelo\Entity\Usuarios;
use Zend\Db\Sql\Sql;

class Formularios extends Form
{
    public $dbAdapter;
    public function __construct($name = null)
     {
        parent::__construct($name);
        
     
        $this->add(array(
            'name' => 'material',
            'options' => array(
                'label' => 'Material',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,

            ),
        ));
		
		$hidden = new Element\Hidden('oculto');
		$this->add($hidden);
		
		$hidden2 = new Element\Hidden('oculto2');
		$this->add($hidden2);
		
		$this->add(array(
            'name' => 'usuario',
            'options' => array(
                'label' => 'Usuario',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
            ),
        ));
        
	$date = new Element\Date('date');
	$date
		->setLabel('Fecha de Reserva')
		
		->setAttributes(array(
			'min'  => '2012-01-01',
			'max'  => '2020-01-01',
			'step' => '1', // days; default step interval is 1 day
    ))
    ->setOptions(array(
        'format' => 'd-m-Y'
    ));
	$this->add($date);

    $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'title' => 'Guardar'
            ),
        ));

     
      $this->add(array(
            'name' => 'buscar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'buscar',
                'title' => 'buscar',
            ),
        ));

     
      $this->add(array(
            'name' => 'eliminar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Eliminar',
                'title' => 'Eliminar'
            ),
        ));

     }
	
}

?>
