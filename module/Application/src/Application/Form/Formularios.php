<?php

namespace Application\Form;

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
        
	$this->add(array(
            'name' => 'usuario',
            'options' => array(
                'label' => 'Usuario',
            ),
            'attributes' => array(
                'type' => 'text',
                'id'   => 'usuario',
                'class' => 'input',
                'required'=>true,

            ),
        ));
		
	$this->add(array(
            'name' => 'pass',
            'options' => array(
                'label' => 'Contrase&ntilde;a',
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'input',
                'id'   => 'password',
                'required'=>true,

            ),
        ));

    $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'id'  => 'enviar',
                'value' => 'Enviar',
                'title' => 'Login'
            ),
        ));


    }
}

?>
